<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
        <script src="{{ asset('/js/main.js') }}"></script>
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
                <input class="form-check-input me-1" type="checkbox" value="">
                <label id="option1"> Option 1 </label>
              </li>
              <li class="list-group-item">
                <input class="form-check-input me-1" type="checkbox" value="">
                <label id="option2"> Option 2 </label>
              </li>
              <li class="list-group-item">
                <input class="form-check-input me-1" type="checkbox" value="">
                <label id="option3"> Option 3 </label>
              </li>
              <li class="list-group-item">
                <input class="form-check-input me-1" type="checkbox" value="">
                <label id="option4"> Option 4 </label>
              </li>
            </ul>


            <ul class="pagination mt-2 float-start" >

              @for($p=1; $p<= $pages; $p++)
                <li class="page-item"><button class="page-link" type="button">{{ $p }}</button></li>
              @endfor
          
            </ul>
                
           <button class="btn btn-primary mt-2 float-end" id="submitBtn">Submit</button>

         </div>
         
        </form>

     </body>
</html>