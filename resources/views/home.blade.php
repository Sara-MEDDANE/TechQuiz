<!DOCTYPE html>
<html>
    <head>

        <link rel="stylesheet" href="{{ asset('/css/main.css') }}">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    </head>


    

    <body>

        <div class="col-11 mx-auto" style="margin-top: 70px;"> 
 
            <h1 id="mainHeading" class="text-center">Welcome to TechQuiz !</h1>
            <h6 class="text-center">Select a category to get started</h6>
           
            @php
               $categories = array(
                                    array("Tech people", "10 questions, 5 min"),
                                    array("Electronics", "10 questions, 5 min"),
                                    array("Tech history", "10 questions, 5 min"),
                                    array("Programming" , "10 questions, 5 min"),
                                    array("Networking", "10 questions, 5 min"),
                                    array("AI", "10 questions, 5 min")
                                  );
             
            @endphp

   
             <ul class="col-6 mx-auto list-group list-group-flush" style="margin-top: 70px;">                    
              @foreach($categories as $category)
                      <li class="list-group-item">
                        <h5 class="d-inline"><a id="quizLink" href="{{ str_replace(' ', '-', $category[0]);}}"> {{$category[0]}} </a></h5>
                        <small class="d-inline float-end" > {{$category[1]}} </small> 
                      </li>       

              @endforeach
             </ul>

        </div>    

    </body>
</html> 