import './bootstrap';

const categoryHeading = document.getElementById("category");
const category = categoryHeading.dataset.category;
const choices = document.getElementById("choices");
const correctChoicesCount = choices.dataset.count;
const pagination = document.getElementById("pages");
const pages = pagination.dataset.pages;
let currentPage = 1;
let decrement; 
let maxCheckedboxes = 1;
let isLoading = false;


function updatePage(p){
  const previousPageElement = document.getElementById('page'+currentPage);
  previousPageElement.classList.remove('active');
  
  currentPage = p; //update to the clicked page
  const currentPageElement = document.getElementById('page'+currentPage);
  currentPageElement.classList.add('active');
}


function limitCheckboxes(correctChoicesCount){

  maxCheckedboxes = correctChoicesCount;
  const checkboxes = document.querySelectorAll("input[type = checkbox]");//get all checkboxes that are checked
  for(let i=0; i<checkboxes.length; i++){ //Add event listener to each checkbox, if it is triggered =>
                                          //compare the number of all checked checkboxes with the number of correct choices 
    checkboxes[i].addEventListener('change', (event)=>{ 
      const checkedboxes = document.querySelectorAll("input[type = checkbox]:checked");  
      if(maxCheckedboxes == 1){//for one choice questions
        checkboxes.forEach(checkbox =>{checkbox.checked = false;});
        checkboxes[i].checked = true;
      }
      else if(checkedboxes.length > maxCheckedboxes){//for more than one choice questions
        checkboxes[i].checked = false;
        alert('You can select only '+maxCheckedboxes+' option(s)!');
      }  
    });
  }  
}


function saveAnswersToSession(){

  const options = document.querySelectorAll("input[type = checkbox]:checked");
  const checkedOptions = Array.from(options).map(checkbox => checkbox.value); //convert the values of the checked checkboxes to an array
  sessionStorage.setItem('question'+currentPage, JSON.stringify(checkedOptions)); //then stringify
}


function getState(){
  
  const fetchedOptions = sessionStorage.getItem('question'+currentPage);
  let optionsArray = JSON.parse(fetchedOptions);

  if(optionsArray === null || optionsArray.length === 0)
  {
   for(let i=1; i<=4; i++) //display the state of the current page, if checkboxes were unchecked, make them unchecked
      document.getElementById("checkbox"+i).checked = false;
  }
  else 
  {
   for(let j=1; j<=4; j++) //display the state of the current page, if checkboxes were checked, make them checked
   { 
     if(optionsArray.includes(document.getElementById("checkbox"+j).value)) 
         document.getElementById("checkbox"+j).checked = true;
     else 
         document.getElementById("checkbox"+j).checked = false;    
   }
  }
}


function fetchQuiz(p){  

  if (isLoading) return; //prevent incoming requests if a request is already bieng processed
  saveAnswersToSession();
  updatePage(p);

  isLoading = true; //request is in progress
  fetch('/api/getQuizData/'+category+'/page/'+currentPage, {method: 'GET'})
  .then(response => {
      if (!response.ok) {
          throw new Error('there is a problem in the backend!');
      }
      return response.json();
  })
  .then(data => {
      console.log(data);
      document.getElementById('question').innerHTML = data.question;
      for(let option=1; option<=4; option++)
       { 
         document.getElementById('checkbox'+option).setAttribute('value', data.choice[option-1]);
         document.getElementById('option'+option).innerHTML = data.choice[option-1];
       }    
      getState();
      limitCheckboxes(data.correctChoicesCount);
  })
  .catch(error => { console.error(error);})
  .finally(()=>{
    isLoading= false;   //reset
  });
}

window.fetchQuiz = fetchQuiz;
window.addEventListener('load', limitCheckboxes(correctChoicesCount), countDown(pages/2));



//-----------------------------------------------------------Submitting data------------------------------------------------- 

document.getElementById("submitBtn").addEventListener("click", emptyAnswers);
        

function countDown(minutes){

  const htmlMin = document.getElementById("minutes");
  const htmlSec =document.getElementById("seconds");
  let sec;

  if(minutes%2 == 0)
    sec = 60;
  else sec = 30;
  minutes = Math.floor(minutes-1);
  htmlMin.innerHTML= minutes;
  decrement = setInterval(function () {
    sec--;
    htmlSec.innerHTML=sec;
    if(minutes == 0 && sec == 0){
      submitAnswers(); 
    }
    else if(minutes!=0 && sec == 0){
      sec = 60;
      minutes--;
      htmlMin.innerHTML= minutes;
    }  
  }, 1000);
}


function emptyAnswers(){

  saveAnswersToSession();
  let is_empty = false;
  for(let i=1; i<=pages; i++){ //undefined problem fixed
    let choices = sessionStorage.getItem('question'+i)
    if( JSON.parse(choices) == '' || choices === null){ //need to convert sessionStorage value from string to array first
      is_empty= true;
      break;
    }
    else is_empty = false;
  }
  if(is_empty == true){
    let submit = confirm("You did not answer all the questions, submit anyway?")
    if(submit == true)
      submitAnswers();
    else console.log("continue quiz");
  }
  else submitAnswers();
}


function submitAnswers(){

  clearInterval(decrement);
  let userAnswers ={};

  for(let i=1; i<=pages; i++)  
  {
    let value = sessionStorage.getItem('question'+i);
    if(JSON.parse(value) !== null)
      userAnswers['question'+i] = value;
  }
  sessionStorage.clear(); 
  fetch('/'+category, {
        method: 'POST',
        body: JSON.stringify({userAnswers}),
        headers: {'Content-Type': 'application/json',
                  'Accept': 'application/json', 
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')}
        })
   .then(response => response.json())
   .then(data => {
      console.log(data);
      document.getElementById("content").innerHTML = data.feedbackContent;
      document.getElementById('showAnswers').addEventListener("click", swap);
   })
   .catch(error => {console.error(error); });
}


function swap() {

  let correction = document.getElementById("correction");

  if (correction.style.display === "none") {
    correction.style.display = "block";
  } 
  else {
    correction.style.display = "none";
  }
}
