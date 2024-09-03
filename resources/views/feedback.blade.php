
        <div class="card col-8 mx-auto mt-5 mb-5">   

            <div class="card-header">
                <h4 style="color:#24ADF3; display: inline-block">TechQuiz | </h4> 
                <h5 style="display: inline-block;"> Tech people feedback</h5>
            </div>

            <div class="card-body">

                <h5 class="card-title mx-3">Your score is {{$score}}/{{$total}}</h5>
                <button class="btn btn-primary col-3 mx-3 mb-4" onclick="Swap()">Show feedback</button>

                <div class="col-10 mx-3 mb-3" id="correction" style="display: none;">

                  @foreach($quiz as $question=>$choices)
                    <div class="mb-3 questionCorr">
                        <h5>{{$question}}</h5>
                        <ul class="list-group">
                          @foreach($choices as $choice=>$details)
                            <li class="list-group-item {{ $details[1] == 1 ? 'correct' : '' }}">
                              <input class="form-check-input me-1" 
                               type="checkbox" value="" 
                               disabled {{$details[2] == true ? 'checked' : 'unchecked'}}>

                              <label class="form-check-label">{{$details[0]}} , to check, is_correct:  {{$details[1]}}</label>
                            </li>
                          @endforeach
                        </ul><br>
                        @endforeach
                    </div>    
                </div>     
            </div>        
        </div>    
 