<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>


    

    <body>

        <form class="card col-8 mx-auto mt-5" action="" method="">
       
         <div class="card-header">
            <h4 style="color:#24ADF3; display: inline-block">TechQuiz | </h4> 
            <h5 style="display: inline-block;"> {{ $category }}</h5>
            <h6 style="display: inline-block; float: right">Time Left  10:00</h6>
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
                
           <button class="btn btn-primary mt-2 float-end" id="submitBtn">Submit</button>

         </div>
         
        </form>

        <script>
          
          var currentPage = 1; 

          function updatePage(p){

              var previousPageElement = document.getElementById('page'+currentPage);
              previousPageElement.classList.remove('active');
            
              currentPage = p; //update to the clicked page

              var currentPageElement = document.getElementById('page'+currentPage);
              currentPageElement.classList.add('active');
          }


          function fetchQuiz(p)
          {
              updatePage(p);

              fetch('/api/getQuizData/'+'{{ $category }}'+'/page/'+currentPage, {method: 'GET'})
              .then(response => {
                  if (!response.ok) {
                      throw new Error('there is a problem in the backend!');
                  }
                  return response.json();
              })
              .then(data => {

                  document.getElementById('question').innerHTML = data.question[0].question;
                  for(var option=1; option<=4; option++)
                   { 
                     document.getElementById('checkbox'+option).setAttribute('value', data.choice[option-1].choice);
                     document.getElementById('option'+option).innerHTML = data.choice[option-1].choice;

                   }    
              })
              .catch(error => { console.error(error);});

          }

          window.addEventListener('load', fetchQuiz(currentPage));

        </script>

     </body>
</html>