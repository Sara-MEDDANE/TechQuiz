<!DOCTYPE html>
<html>
    <head>

        <link rel="stylesheet" href="{{ asset('/css/main.css') }}">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    </head>


    

    <body>

        <form class="card col-8 mx-auto mt-5" action="" method="">

         <div class="card-header">
            <h4 style="color:#24ADF3; display: inline-block">TechQuiz | </h4> 
            <h5 style="display: inline-block;"> Tech people</h5>
            <h6 style="display: inline-block; float: right">Time Left  10:00</h6>
         </div>

         <div class="card-body">
           <h5 class="card-title">1.Question one. choose 2.</h5>
 
           <ul class="list-group">
              <li class="list-group-item">
                <input class="form-check-input me-1" type="checkbox" value="">
                Option 1
              </li>
              <li class="list-group-item">
                <input class="form-check-input me-1" type="checkbox" value="">
                Option 2
              </li>
              <li class="list-group-item">
                <input class="form-check-input me-1" type="checkbox" value="">
                Option 3
              </li>
              <li class="list-group-item">
                <input class="form-check-input me-1" type="checkbox" value="">
                Option 4
              </li>
            </ul>


            <ul class="pagination mt-2 float-start" >

              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item active"> <a class="page-link"> 2 </a> </li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>

            </ul>
       
                
           <a href="" class="btn btn-primary mt-2 float-end">Submit</a>

 

         </div>
         
        </form>

    </body>
</html>