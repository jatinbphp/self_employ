@extends('frontend.layouts.app')

@section('content')
    <div class="main-content-bx01 bg-colorbx">
        <div class="container">
            <div class="row">
                <div class="post-task-title">
                    <h1>Post a task</h1>
                </div>
                <div class="post-taskbx01">
                    <div class="form-spacebx1">
                        <h2>Let's start with the basics</h2>
                        @foreach ($errors->all() as $error)
                        @endforeach


                        <form method="post" action="{{ route('posts.update',$post->id) }}" id="post_task" enctype="multipart/form-data">
                            @csrf
                            <p>What do you need done?</p>
                            <div class="form-group required-fieldbx">
                                <input type="text" name="name" value="{{ old('name', $post->name) }}"
                                    class="form-control form-control-lg {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                    placeholder="e.g Help move my home furnititure">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <p>When do you need to be done?</p>
                            <div class="form-inputrow">
                                <div class="form-group formspace01 date-inputbx1">
                                    <label>On Date</label>
                                    <input type="date" name="date"
                                        class="form-control form-control-lg datepicker  {{ $errors->has('date') ? 'is-invalid' : '' }}"
                                        min="{{ \Carbon\Carbon::today()->format('m/d/Y') }}" placeholder="Date" value="{{ $post->date }}">
                                    @error('date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group formspace01 date-inputbx1">
                                    <div class="form-group">
                                        <label>Before Date</label>
                                        <input type="date" name="before_date"
                                            class="form-control form-control-lg datepicker  {{ $errors->has('before_date') ? 'is-invalid' : '' }}"
                                            min="{{ \Carbon\Carbon::today()->format('m/d/Y') }}" placeholder="Before Date" value="{{ $post->beforedate }}">
                                        @error('before_date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group formspace01 flexible-btn">
                                    <input type="checkbox" name="is_flexible" value="1"
                                        class="hidden flexible-bx1 datepicker" id="cb" {{ ($post->is_flexible == 1) ? 'checked' : '' }} >
                                    <label for="cb">I’m flexible </label>
                                </div>

                            </div>
                            <div class="certain_time d-none mb-0">
                                <input type="checkbox" name="certain_time"
                                    class="certian pl-5 {{ $errors->has('certain_time') ? 'is-invalid' : '' }}"
                                    value="1" {{ old('certain_time', $post->certain_time) == true ? 'checked' : '' }}>
                                <label for="certain_time">I need a certain time of day</label>
                                @error('certain_time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-inputrow flexible d-none">
                                @foreach ($flexibles as $flexible)
                                    <div class="form-group checkbxes01">
                                        <input type="checkbox" name="felxible[]" value="{{ $flexible->id }}" {{ in_array($flexible->id, explode(',',$post->flexible_time_id)) ? 'checked': '' }}>
                                        <div class="checkbxesalige-bx1">
                                            <img src="{{ asset('assets/images/' . $flexible->icon) }}">
                                            <label for="vehicle1">{{ $flexible->name }}</label>
                                            <p>{{ $flexible->time }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <p>Category</p>
                            <div class="form-group required-fieldbx">
                                <div class="form-group">
                                    <select class="form-select {{ $errors->has('category') ? 'is-invalid' : '' }}"
                                        name="category" id="category">
                                        <option value="">Please Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <p>Skills</p>
                            <div class="form-group required-fieldbx">
                                <div class="form-group">
                                    <select
                                        class="form-select select2 skills {{ $errors->has('skills[]') ? 'is-invalid' : '' }}"
                                        name="skills[]" multiple style="height:100px !important">
                                        <option value="">Please Select Category for skill selection</option>
                                    </select>
                                    @error('skills[]')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <p>Where do you need to be done?</p>
                            <div class="form-group required-fieldbx">
                                <div class="address-bx11">
                                    <div class="address-iconbx"><img src="{{ asset('assets/images/map-icon.png') }}"></div>
                                    <input type="hidden" name="latitude" id="latitude">
                                    <input type="hidden" name="longitude" id="longitude">
                                    <input type="text" name="address" value="{{ old('address',$post->address) }}"
                                        class="form-control form-control-lg {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                        id="address" placeholder="Sydney NSW, Australia" onkeypress="initAddress(this,'address')" />
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <p>Provide more details</p>
                            <div class="form-group required-fieldbx">
                                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" rows="5"
                                    id="comment" placeholder="What are the details?">{{ old('description',$post->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <p>Images</p>
                            <div class="form-group">
                                <div class="form-inputrow2">
                                    <div class="image-uploadfile">
                                        <label for="first-img1"><i class="fa fa-plus" aria-hidden="true"></i></label>
                                        <input type="file" name="images[]" id="first-img1"
                                            class="{{ $errors->has('images[]') ? 'is-invalid' : '' }}"
                                            style="display: none;visibility: none;" multiple>
                                        @error('images[]')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <p>What is your budget?</p>
                            <div class="form-group required-fieldbx">
                                <div class="address-bx11">
                                    <div class="address-iconbx">$</div>
                                    <input type="number" name="amount" value="{{ old('amount', $post->amount) }}"
                                        class="form-control form-control-lg {{ $errors->has('amount') ? 'is-invalid' : '' }}"
                                        placeholder="Amount eg. 5">
                                    @error('amount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <p>What is your budget Type (Per Day, Per Project, Per Hour)?</p>
                            <div class="form-group required-fieldbx">
                                <select name="budget" id="budget"
                                    class="form-select form-control-lg {{ $errors->has('budget') ? 'is-invalid' : '' }}">
                                    <option value="0">Please Select Buget Type</option>
                                    @foreach ($bugets as $budget)
                                        <option value="{{ $budget->id }}"
                                            {{ old('budget', $post->budget_id) == $budget->id ? 'selected' : '' }}>{{ $budget->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('budget')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="submit-btnbx0">
                                <button type="submit" id="post_task_submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
