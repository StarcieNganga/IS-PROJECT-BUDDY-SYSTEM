<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dorm-Mate Match Survey</title>

  <!-- bootstrap .css -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- page .css -->
  <link rel="stylesheet" type="text/css" href="assets/css/survey.css">

</head>
<body>
  <div class="container">
    <div class="jumbotron">
      <h1>North Central Washington University</h1>
      <h3 id="sub-header">Dorm Roommate Match Survey Results</h3>
      <hr>
      <h4 id="sub-header-2">Your three best matches based on survey comparison</h4>
      <a href="/"><button id="home" class="btn btn-primary btn-lg"><span class="fa fa-plus"></span>Home</button></a>
    </div>


    <div id="survey-form" class="row">
      <div class="col">
          <form>
              <div class="form-group">
                <label for="name-input">Name</label>
                <input type="text" class="form-control" id="user-name" placeholder="">
                <label for="photo-input">Photo Link (link to internet based self-photo)</label>
                <input type="text" class="form-control" id="photo-path" placeholder="https://loremflickr.com/320/240/student">
              </div>
              <div class="form-group">
                <label class="question-label" id="survey-question-1" for="survey-question"></label>
                <select class="form-control question" id="question1">
                  <option value="" selected="selected" hidden="hidden"  >Select answer</option>
                  <option value="1">1 - Not Important</option>
                  <option value="2">2 - Slightly Important</option>
                  <option value="3">3 - Somewhat Important</option>
                  <option value="4">4 - Very Important</option>
                  <option value="5">5 - Extremely Important</option>
                </select>
                <label class="question-label" id="survey-question-2" for="survey-question"></label>
                <select class="form-control question" id="question2">
                  <option value="" selected="selected" hidden="hidden"  >Select answer</option>
                  <option value="1">1 - Not Important</option>
                  <option value="2">2 - Slightly Important</option>
                  <option value="3">3 - Somewhat Important</option>
                  <option value="4">4 - Very Important</option>
                  <option value="5">5 - Extremely Important</option>
                </select>
                <label class="question-label" id="survey-question-3" for="survey-question"></label>
                <select class="form-control question" id="question3">
                  <option value="" selected="selected" hidden="hidden"  >Select answer</option>
                  <option value="1">1 - Not Important</option>
                  <option value="2">2 - Slightly Important</option>
                  <option value="3">3 - Somewhat Important</option>
                  <option value="4">4 - Very Important</option>
                  <option value="5">5 - Extremely Important</option>
                </select>
                <label class="question-label" id="survey-question-4" for="survey-question"></label>
                <select class="form-control question" id="question4">
                  <option value="" selected="selected" hidden="hidden"  >Select answer</option>
                  <option value="1">1 - Not Important</option>
                  <option value="2">2 - Slightly Important</option>
                  <option value="3">3 - Somewhat Important</option>
                  <option value="4">4 - Very Important</option>
                  <option value="5">5 - Extremely Important</option>
                </select>
                <label class="question-label" id="survey-question-5" for="survey-question"></label>
                <select class="form-control question" id="question5">
                  <option value="" selected="selected" hidden="hidden"  >Select answer</option>
                  <option value="1">1 - Not Important</option>
                  <option value="2">2 - Slightly Important</option>
                  <option value="3">3 - Somewhat Important</option>
                  <option value="4">4 - Very Important</option>
                  <option value="5">5 - Extremely Important</option>
                </select>
                <label class="question-label" id="survey-question-6" for="survey-question"></label>
                <select class="form-control question" id="question6">
                  <option value="" selected="selected" hidden="hidden"  >Select answer</option>
                  <option value="1">1 - Not Important</option>
                  <option value="2">2 - Slightly Important</option>
                  <option value="3">3 - Somewhat Important</option>
                  <option value="4">4 - Very Important</option>
                  <option value="5">5 - Extremely Important</option>
                </select>                
                <label class="question-label" id="survey-question-7" for="survey-question"></label>
                <select class="form-control question" id="question7">
                  <option value="" selected="selected" hidden="hidden"  >Select answer</option>
                  <option value="1">1 - Not Important</option>
                  <option value="2">2 - Slightly Important</option>
                  <option value="3">3 - Somewhat Important</option>
                  <option value="4">4 - Very Important</option>
                  <option value="5">5 - Extremely Important</option>
                </select>
                <label class="question-label" id="survey-question-8" for="survey-question"></label>
                <select class="form-control question" id="question8">
                  <option value="" selected="selected" hidden="hidden"  >Select answer</option>
                  <option value="1">1 - Not Important</option>
                  <option value="2">2 - Slightly Important</option>
                  <option value="3">3 - Somewhat Important</option>
                  <option value="4">4 - Very Important</option>
                  <option value="5">5 - Extremely Important</option>
                </select>
                <label class="question-label" id="survey-question-9" for="survey-question"></label>
                <select class="form-control question" id="question9">
                  <option value="" selected="selected" hidden="hidden"  >Select answer</option>
                  <option value="1">1 - Not Important</option>
                  <option value="2">2 - Slightly Important</option>
                  <option value="3">3 - Somewhat Important</option>
                  <option value="4">4 - Very Important</option>
                  <option value="5">5 - Extremely Important</option>
                </select>
                <label class="question-label" id="survey-question-10" for="survey-question"></label>
                <select class="form-control question" id="question10">
                  <option value="" selected="selected" hidden="hidden"  >Select answer</option>
                  <option value="1">1 - Not Important</option>
                  <option value="2">2 - Slightly Important</option>
                  <option value="3">3 - Somewhat Important</option>
                  <option value="4">4 - Very Important</option>
                  <option value="5">5 - Extremely Important</option>
                </select>                
              </div>
              <input id="submit" class="btn btn-success" type="submit" value="Submit">
            </form>
      </div>
    </div>

    <div id="survey-results" class="row">
      <div class="col">
        <div class="card" style="width: 20rem;">
          <img id="pic-1" src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Best Match</h5>
            <p id="name-1" class="card-text">Name Goes Here</p>
            <p id="compat-rating-1" class="card-text">Compatibility Rating: </p>
          </div>
          <p class="survey-results-title">Survey Results</p>
          <div id="answers-1" class="answers">
          </div>
        </div>
      </div>
 
      <div class="col">
        <div class="card" style="width: 20rem;">
          <img id="pic-2" src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Second Match</h5>
            <p id="name-2" class="card-text">Name Goes Here</p>
            <p id="compat-rating-2" class="card-text">Compatibility Rating: </p>
          </div>
          <p class="survey-results-title">Survey Results</p>
          <div id="answers-2" class="answers">
          </div>
        </div>
      </div>


      <div class="col">
        <div class="card" style="width: 20rem;">
          <img id="pic-3" src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Third Match</h5>
            <p id="name-3" class="card-text">Name Goes Here</p>
            <p id="compat-rating-3" class="card-text">Compatibility Rating: </p>
          </div>
          <p class="survey-results-title">Survey Results</p>
          <div id="answers-3" class="answers">
          </div>
        </div>
      </div>
    </div>  

    <div id="my-modal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custom">
          <div class="modal-header">
            <h5 class="modal-title">Survey Form Questions</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Please complete the questions highlighted in red.</p>
            <p>Thank you.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

  </div>

      <!-- Main program javascript -->
      <script src="https://code.jquery.com/jquery.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script src="assets/javascript/survey.js"></script>
  
     <footer>

 <div class="footer_credit">
            <div class="footer_inner_credit">
    <footer class="footer">
        <p><b>BUDDY WEB APPLICATION</p></b>
        <div class="contacts">
            <p>Contact Us:</p>
            <p>Phone: <a href="tel:+254704949417">+254704949417</a></p>
        </div>
      </div>
      </div>
      </div>
        </footer>

   
  
  </body>
</html>
