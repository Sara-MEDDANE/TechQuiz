
<html>
    <head>

        <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
        <script src="{{ asset('/js/main.js') }}"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    </head>


    

    <body>

        <div class="card col-8 mx-auto mt-5">   
            
            <div class="card-header">
                <h4 style="color:#24ADF3; display: inline-block">TechQuiz | </h4> 
                <h5 style="display: inline-block;"> Tech people feedback</h5>
            </div>

            <div class="card-body">

                <h5 class="card-title mx-3">Your score is 8/10</h5>
                <button class="btn btn-primary col-3 mx-3 mb-4" onclick="Swap()">Show feedback</button>

                <div class="col-10 mx-3 mb-3" id="correction" style="display: none;">

                    <div class="mb-3 questionCorr">
                        <h5>1.Question one. choose 2.</h5>

                        <ul class="list-group">
                          <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" value="" disabled checked>
                            Option 1
                          </li>
                          <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" value="" disabled>
                            Option 2
                          </li>
                          <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" value="" disabled>
                            Option 3
                          </li>
                          <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" value="" disabled>
                            Option 4
                          </li>
                        </ul>

                    </div>    

                    <div class="questionCorr">
                        <h5>2.Question two. choose 2.</h5>

                        <ul class="list-group">
                          <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" value="" disabled>
                            Option 1
                          </li>
                          <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" value=""disabled>
                            Option 2
                          </li>
                          <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" value="" disabled checked>
                            Option 3
                          </li>
                          <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" value="" disabled>
                            Option 4
                          </li>
                        </ul>

                    </div>                       

                </div>    
                

            </div>

        
        </div>    

    </body>


</html>