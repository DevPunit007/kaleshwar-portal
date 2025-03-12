@extends('templates.default')

@section('content')
    <div class="add-location container">
        <div class="card rounded-0">
            <div class="card-body">
                <form id="add-location-form" method="post" action="{{ route('location-add', app()->getLocale()) }}" enctype="multipart/form-data">@csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="language">Language</label>
                                <select name="language" id="language" class="custom-select col-lg-6 col-sm-12">
                                    @foreach($languages as $language)
                                        <option value="{{$language->language_code}}">{{__('login.language.' . $language->language_code)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="geodata">Geodata</label>
                                <input id="geodata" class="form-control" type="text" name="geodata" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" class="form-control" type="text" name="name" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="address-street">Street</label>
                                <input id="address-street" class="form-control" type="text" name="address_street" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="address-no">Address Number</label>
                                <input id="address-no" class="form-control" type="text" name="address_no" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="address-supplements">Address Supplement</label>
                                <input id="address-supplements" class="form-control" type="text" name="address_supplements" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input id="city" class="form-control" type="text" name="city" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="state">State</label>
                                <input id="state" class="form-control" type="text" name="state" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="zip">Zip</label>
                                <input id="zip" class="form-control" type="text" name="zip" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input id="country" class="form-control" type="text" name="country" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn w-50 text-light mt-3 color-brand-blue" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
