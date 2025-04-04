
@extends('templates.default')

@section('content')
    <div class="container">
        <div class="card rounded-0 mb-2">
            <div class="card-body">

                    <form method="post" action="{{ route('timeline-add-dates', app()->getLocale()) }}" enctype="multipart/form-data">@csrf

							  <div class="form-row">
								<div class="form-group col-md-6">
								  <label for="inputEmail4">Email</label>
								  <input type="email" class="form-control" id="inputEmail4">
								</div>
								<div class="form-group col-md-6">
								  <label for="inputPassword4">Password</label>
								  <input type="password" class="form-control" id="inputPassword4">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputAddress">Address</label>
								<input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
							  </div>
							  <div class="form-group">
								<label for="inputAddress2">Address 2</label>
								<input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
							  </div>
							  <div class="form-row">
								<div class="form-group col-md-6">
								  <label for="inputCity">City</label>
								  <input type="text" class="form-control" id="inputCity">
								</div>
								<div class="form-group col-md-4">
								  <label for="inputState">State</label>
								  <select id="inputState" class="form-control">
									<option selected>Choose...</option>
									<option>...</option>
								  </select>
								</div>
								<div class="form-group col-md-2">
								  <label for="inputZip">Zip</label>
								  <input type="text" class="form-control" id="inputZip">
								</div>
							  </div>


 
      
      
							  <div class="form-group row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary float-right submit-button">Create</button>
                            </div>
                        </div>
                    </form>
            </div>
             <div class="card-body">       
                    <form>
					  <div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-10">
						  <input type="email" class="form-control" id="inputEmail3">
						</div>
					  </div>
					  <div class="form-group row">
						<label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
						<div class="col-sm-10">
						  <input type="password" class="form-control" id="inputPassword3">
						</div>
					  </div>
					  <fieldset class="form-group">
						<div class="row">
						  <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
						  <div class="col-sm-10">
							<div class="form-check">
							  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
							  <label class="form-check-label" for="gridRadios1">
								First radio
							  </label>
							</div>
							<div class="form-check">
							  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
							  <label class="form-check-label" for="gridRadios2">
								Second radio
							  </label>
							</div>
							<div class="form-check disabled">
							  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>
							  <label class="form-check-label" for="gridRadios3">
								Third disabled radio
							  </label>
							</div>
						  </div>
						</div>
					  </fieldset>
					  <div class="form-group row">
						<div class="col-sm-2">Checkbox</div>
						<div class="col-sm-10">
						  <div class="form-check">
							<input class="form-check-input" type="checkbox" id="gridCheck1">
							<label class="form-check-label" for="gridCheck1">
							  Example checkbox
							</label>
						  </div>
						</div>
					  </div>
					  <div class="form-group row">
						<div class="col-sm-10">
						  <button type="submit" class="btn btn-primary">Sign in</button>
						</div>
					  </div>
					</form>
                
            </div>
        </div>
    </div>
@endsection
