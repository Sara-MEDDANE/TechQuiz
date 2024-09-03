<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>


    

    <body>

    <div id="content">
        <form class="card col-8 mx-auto mt-5">
       
         <div class="card-header">
            <h4 style="color:#24ADF3; display: inline-block">TechQuiz | </h4> 
            <h5 style="display: inline-block;"> {{ $category }}</h5>

            <h6 id="timer" style="display: inline-block; float: right">
              Time left: &nbsp;
              <span id="minutes">{{$pages/2}}</span>
              minute(s) and
              <span id="seconds" >00</span>
              second(s)
            </h6>
         </div>

         <div class="card-body">
           <h5 class="card-title" id="question">1.Question one. choose 2.</h5>
 
           <ul class="list-group">
              <li class="list-group-item">
                <input class="form-check-input me-1" type="checkbox" value="" id="checkbox1">
                <label id="option1"> Option 1 </label>
              </li>
              <li class="list-group-item">
                <input class="form-check-input me-1" type="checkbox" value="" id="checkbox2">
                <label id="option2"> Option 2 </label>
              </li>
              <li class="list-group-item">
                <input class="form-check-input me-1" type="checkbox" value="" id="checkbox3">
                <label id="option3"> Option 3 </label>
              </li>
              <li class="list-group-item">
                <input class="form-check-input me-1" type="checkbox" value="" id="checkbox4">
                <label id="option4"> Option 4 </label>
              </li>
            </ul>


            <ul class="pagination mt-2 float-start" >

              @for($p=1; $p<= $pages; $p++)
                <li id='page{{$p}}' class="page-item"><button onclick = "fetchQuiz({{$p}})" class="page-link" type="button">{{ $p }}</button></li>
              @endfor
  
            </ul>
                
           <button class="btn btn-primary mt-2 float-end" id="submitBtn" type="button">Submit</button>

         </div>
         
        </form>
      </div>

        <script>
          
          var currentPage = 1;
          let decrement; 

          function updatePage(p){
            const previousPageElement = document.getElementById('page'+currentPage);
            previousPageElement.classList.remove('active');
          
            currentPage = p; //update to the clicked page
            const currentPageElement = document.getElementById('page'+currentPage);
            currentPageElement.classList.add('active');
          }


          function limitCheckboxes(maxCheckedboxes){

            const checkboxes = document.querySelectorAll("input[type = checkbox]");//get all checkboxes that are checked

            for(let i=0; i<checkboxes.length; i++){ //Add event listener to each checkbox, if it is triggered =>
                                                    //compare the number of all checked checkboxes with the number of correct choices 
              checkboxes[i].addEventListener('change', (event)=>{ 
                const checkedboxes = document.querySelectorAll("input[type = checkbox]:checked");  
                if(checkedboxes.length > maxCheckedboxes){
                  checkboxes[i].checked = false;
                  alert('You can select only '+maxCheckedboxes+' option(s)!');
                }  
              });
            }  
          }


          function saveAnswersToSession(){

            const options = document.querySelectorAll("input[type = checkbox]:checked");
            const checkedOptions = Array.from(options).map(checkbox => checkbox.value);
            //console.log(JSON.stringify(checkedOptions));
            sessionStorage.setItem('question'+currentPage, JSON.stringify(checkedOptions)); 

          }


          function getState(){

            const fetchedOptions = sessionStorage.getItem('question'+currentPage);
            var optionsArray = JSON.parse(fetchedOptions);

            if(optionsArray === null || optionsArray.length === 0)
            {
             for(let i=1; i<=4; i++) //display the state of the current page, if checkboxes were checked, make them checked
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



          function fetchQuiz(p)
          {   
              saveAnswersToSession();
              updatePage(p);

              fetch('/api/getQuizData/'+'{{ $category }}'+'/page/'+currentPage, {method: 'GET'})
              .then(response => {
                  if (!response.ok) {
                      throw new Error('there is a problem in the backend!');
                  }
                  return response.json();
              })
              .then(data => {
                  console.log(data);
                  document.getElementById('question').innerHTML = data.question[0].question;
                  for(let option=1; option<=4; option++)
                   { 
                     document.getElementById('checkbox'+option).setAttribute('value', data.choice[option-1].choice);
                     document.getElementById('option'+option).innerHTML = data.choice[option-1].choice;
                   }    
                  limitCheckboxes(data.correctChoicesCount);
                  getState();
              })
              .catch(error => { console.error(error);});

          }

          window.addEventListener('load', fetchQuiz(currentPage), countDown({{ $pages/2 }}));

 //-----------------------------------------------------------Submitting data------------------------------------------------- 

          document.getElementById("submitBtn").addEventListener("click", submitAnswers);
        
          function countDown(minutes){

            const htmlMin = document.getElementById("minutes");
            const htmlSec =document.getElementById("seconds");
            let sec=60;
            minutes = minutes-1;
            htmlMin.innerHTML= minutes;
            decrement = setInterval(function () {
              sec--;
              htmlSec.innerHTML=sec;
              if(minutes == 0 && sec == 0){
                submitAnswers();
                clearInterval(decrement);  
              }
              else if(minutes!=0 && sec == 0){
                sec = 60;
                minutes--;
                htmlMin.innerHTML= minutes;
              }  
            }, 1000);
          }

          function submitAnswers(event){

            clearInterval(decrement);
            saveAnswersToSession();
            let userAnswers ={};
            for(let i=1; i<=sessionStorage.length; i++)
            {
              let value = sessionStorage.getItem('question'+i);
              userAnswers['question'+i] = value;
            }
            sessionStorage.clear(); 

            fetch('/{{ $category }}', {
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
             })
             .catch(error => {console.error(error); });
          }

          function Swap() {
            let correction = document.getElementById("correction");
    
            if (correction.style.display === "none") {
              correction.style.display = "block";
            } 
            else {
              correction.style.display = "none";
            }
          }
          

          </script>

     </body>
</html>