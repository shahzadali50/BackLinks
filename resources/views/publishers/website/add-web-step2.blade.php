@extends('layouts.app')
@section('title')
Add Web | {{ auth()->user()->role }}
@endsection
@section('css')
<style>
    .bg-new-lighter {
        background-color: #f8f9fa;
        /* Adjust as needed */
    }

    .lateral-aside {
        padding: 10px;
    }

    .div-paso {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .badges-pasos {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-right: 10px;
    }

    .circle-pasos {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
        color: white;
    }

    .circle-activep {
        background-color: #28a745;
        /* Green for active/completed steps */
    }

    .circle-inactive {
        background-color: #6c757d;
        /* Gray for inactive steps */
    }

    .check-pasos {
        font-size: 16px;
    }

    .line-pasos,
    .line-pasos-donep {
        width: 2px;
        height: 30px;
        background-color: #6c757d;
        /* Gray for default lines */
    }

    .line-pasos-donep {
        background-color: #28a745;
    }

    .texto-pasos {
        flex: 1;
    }

    .p-pasos-active {
        font-weight: bold;
        color: #28a745;
        /* Green for active text */
    }

    .p-pasos {
        font-weight: normal;
        color: #6c757d;
        /* Gray for inactive text */
    }
</style>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
publishers
@endslot
@slot('title')
Add Web
@endslot
@endcomponent
<div class="row">
    {{-- <div class="col-md-8 col-12 py-2">
        @if(session('success'))
         <div class="alert alert-secondary alert-dismissible bg-secondary text-white alert-label-icon fade show" role="alert">
             <i class="ri-check-double-line label-icon"></i> <strong>Success</strong> - {{ session('success') }}
             <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
         @endif
     </div> --}}
    <div class="col-md-10">

        <div class="card">
            <div class="card-header ">
                <h3 class="mb-1 ">
                    2. Complete the data</h3>

            </div>
            <div class="card-body">
                <form action="{{ route('publishers.form.postStep2') }}" method="POST">
                    @csrf
                    <div class="row">
                          {{-- Website description --}}
                        <div class="col-12 mb-3">
                            <label for="website_description" class="form-label">Website description <span
                                class="text-danger">*</span> <small class="text-body-tertiary">(It is not
                                allowed to add contact details)</small>
                        </label>
                            <textarea required id="website_description" class="form-control" name="web_description"  cols="" rows="5"> {{ old('web_description') }}</textarea>
                            @error('web_description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        {{-- country --}}
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="Select_Country">Your main audience is from (country): <span
                                        class="text-danger">*</span></label>
                                <select name="audience" class="Select_Country">
                                    @foreach(config('countries.countries') as $country)
                                    <option value="{{ $country }}" {{ old('audience')==$country ? 'selected' : '' }}>{{
                                        $country }}</option>

                                    @endforeach

                                </select>
                                @error('audience')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- How many images per post --}}
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label>How many images per post<span class="text-danger">*</span></label>
                                <select name="images_per_post" class="images_per_post">
                                    <option value="" disabled selected>Select an options</option>
                                    @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}" {{ old('images_per_post')==$i
                                        ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor

                                </select>
                                @error('images_per_post')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- Maximum amount of links per post --}}
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label>Maximum amount of links per post<span class="text-danger">*</span></label>
                                <select name="post_link" class="links_per_post">
                                    <option value="" disabled selected>Select an options</option>
                                    @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}" {{ old('post_link')==$i
                                        ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                </select>
                                @error('post_link')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- Type of links admitted --}}
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label>Type of links admitted <span class="text-danger">*</span></label>
                                <select name="link_type" class="js-example-basic-single links_admitted"
                                    id="links_admitted">
                                    <option value="" disabled selected>Select an option</option>
                                    <option value="Follow" {{ old('link_type')=='Follow' ? 'selected' : '' }}>Follow
                                    </option>
                                    <option value="No Follow" {{ old('link_type')=='No Follow' ? 'selected' : '' }}>No
                                        Follow</option>
                                    <option value="Sponsored" {{ old('link_type')=='Sponsored' ? 'selected' : '' }}>
                                        Sponsored</option>
                                </select>
                                @error('link_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <div>
                                    <label for="Website_Language">Language(s) of your Website <span class="text-danger">*</span></label>
                                </div>
                                <select required class="js-example-basic-multiple" name="language" id="Website_Language">
                                    <option value="" disabled selected>Select a Language</option>
                                    <option value="catalan" {{ old('language') == 'catalan' ? 'selected' : '' }}>Catalán</option>
                                    <option value="english" {{ old('language') == 'english' ? 'selected' : '' }}>English</option>
                                    <option value="esukera" {{ old('language') == 'esukera' ? 'selected' : '' }}>Esukera</option>
                                    <option value="french" {{ old('language') == 'french' ? 'selected' : '' }}>French</option>
                                    <option value="gallego" {{ old('language') == 'gallego' ? 'selected' : '' }}>Gallego</option>
                                    <option value="german" {{ old('language') == 'german' ? 'selected' : '' }}>German</option>
                                    <option value="italiano" {{ old('language') == 'italiano' ? 'selected' : '' }}>Italiano</option>
                                    <option value="portuguese" {{ old('language') == 'portuguese' ? 'selected' : '' }}>Portuguese</option>
                                    <option value="spanish" {{ old('language') == 'spanish' ? 'selected' : '' }}>Spanish</option>
                                </select>
                                @error('language')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Select your website categories (maximum 3) * --}}
                        <div class="col-12 mt-3">
                            <label>Select your website categories (maximum 3)<span class="text-danger">*</span></label>
                            @error('categories')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="d-flex flex-wrap">
                                @foreach (config('categories.categories') as $category)
                                <div class="form-check form-check-info mb-3 mx-3">
                                    <input id="checkbox-category-{{ $category['id'] }}" name="categories[]"
                                        class="form-check-input" type="checkbox" value="{{ $category['label'] }}" {{
                                        in_array($category['label'], old('categories', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="checkbox-category-{{ $category['id'] }}">
                                        {{ $category['label'] }}
                                    </label>
                                </div>
                                @endforeach

                            </div>

                        </div>
                        {{-- Type of links admitted --}}
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label>Delicated topics you do not accept</label>
                                <select name="delicated_topics[]" class="js-example-basic-multiple" multiple="multiple">
                                    @foreach (config('delicated_topics.topics') as $topic)
                                        <option value="{{ $topic }}"
                                            @if (is_array(old('delicated_topics')) && in_array($topic, old('delicated_topics'))) selected @endif>
                                            {{ $topic }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('delicated_topics')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- Sponsorship notification --}}
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label>Sponsorship notification <span class="text-danger">*</span></label>
                                <select name="sponsorship" class="delicated_topics">
                                    <option value="" disabled selected>Select an options</option>

                                    <option value="Always" {{ old('sponsorship')=='Always' ? 'selected' : '' }}>Always
                                    </option>
                                    <option value="Only if its is noticed" {{
                                        old('sponsorship')=='Only if its is noticed' ? 'selected' : '' }}>Only if its is
                                        noticed</option>

                                </select>
                                @error('sponsorship')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- Activism and NGOs --}}
                        <div class="col-sm-6">
                            <div class="form-check form-check-info mb-3 mx-3">
                                <input value="1" id="your_website" name="publish_web" class="form-check-input"
                                    type="checkbox" {{ old('publish_web') ? 'checked' : '' }}>
                                <label class="form-check-label" for="your_website">
                                    Do you publish on the home of your website?
                                </label>
                            </div>
                            @error('your_website')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- Do you publish in related categories? --}}
                        <div class="col-sm-6">
                            <div class="form-check form-check-info mb-3 mx-3">
                                <input value="1" id="related_categories" name="publish_categories"
                                    class="form-check-input" type="checkbox" {{ old('publish_categories') ? 'checked'
                                    : '' }}>
                                <label class="form-check-label" for="related_categories">
                                    Do you publish in related categories?
                                </label>
                            </div>
                            @error('publish_categories')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- Sponsored post price --}}
                        <div class="col-12 mt-3">
                            <h5> Sponsored post price <span class="text-danger">*</span></h5>
                            <div class="border p-4">
                                <h6>Normal price</h6>
                                <div class="alert alert-secondary" role="alert">
                                    <strong> This is amount that we will pay you for every sponsored post of 500
                                        palabras you write. The amount is the suggested according to your SEO metrics,
                                        but you can change this number and modify it once per month. </strong>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">€</span>
                                    <input name="normal_price" type="number" value="{{ old('normal_price', 50) }}"
                                        class="form-control" step="0.5">

                                </div>
                                @error('normal_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div>

                                </div>
                                <h6>Delicated topics price (optional )</h6>
                                <div class="alert alert-secondary" role="alert">
                                    <strong>Establish the price you want to earn if you accept post about delicated
                                        topics and this is higher than the normal price previously indicated.
                                        The delicated topics included in this price are: Casino, CBD, Crypto, Dating,
                                        Drug, Escorts, Gambling, Growshop, Medication, Politics, Promotional articles,
                                        Religion, Sexshop, Sexuality, Tarot and Esotericism</strong>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">€</span>
                                    <input name="dedicated_price" type="number"
                                        value="{{ old('dedicated_price', 100) }}" class="form-control" step="0.5">
                                    @error('delicated_price')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        {{-- Extras (optional) --}}
                        <div class="col-12 mt-3">
                            <h5> Extras (optional) </h5>
                            <div class="border p-4">

                                <div>
                                    <h6>Add more words</h6>
                                    <div class="alert alert-dark" role="alert">
                                        <strong> Posts must be a minimum of 500 words.
                                            Set the price for expanding to 800, 1,000 and 1,200 total words or leave it
                                            blank if you prefer not to expand at all.</strong>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="">+300 words (800 total)</label>
                                            <div class="input-group mb-3 align-items-center">

                                                <span class="input-group-text" id="basic-addon1">€</span>
                                                <input name="800_words" type="number" value="50" class="form-control"
                                                    step="0.5">

                                            </div>
                                            @error('800_words')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="">+500 words (1.000 total)</label>
                                            <div class="input-group mb-3 align-items-center">

                                                <span class="input-group-text" id="basic-addon1">€</span>
                                                <input value="{{ old('1000_words') }}" name="1000_words" type="number"
                                                    value="50" class="form-control" step="0.5">

                                            </div>
                                            @error('1000_words')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="">+700 words (1.200 total)</label>
                                            <div class="input-group mb-3 align-items-center">

                                                <span class="input-group-text" id="basic-addon1">€</span>
                                                <input name="1200_words" type="number" value="50" class="form-control"
                                                    step="0.5" value="{{ old('1200_words') }}">

                                            </div>
                                            @error('1200_words')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                {{-- Diffusion in social networks --}}
                                <div>
                                    <h6>Diffusion in social networks</h6>
                                    <div class="alert alert-dark" role="alert">
                                        <strong>Add your social networks and generate extra income by sharing sponsored
                                            posts there.
                                            Introduce also the price for spreading the post on all your
                                            networks.</strong>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <div class="">

                                                <label for=""> <i class="fa fa-facebook-square" aria-hidden="true"></i>
                                                    https://www.facebook.com/</label>

                                                <input value="{{ old('facebook_link') }}" name="facebook_link"
                                                    type="url" class="form-control" placeholder="publishers">
                                                @error('facebook_link')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <div>
                                                <label for=""> <i class="fab fa-x-twitter"></i>https://x.com/</label>

                                                <input value="{{ old('x_link') }}" name="x_link" type="url"
                                                    class="form-control" placeholder="publishers">
                                                @error('x_link')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <div>
                                                <label for=""> <i
                                                        class="fa fa-linkedin-square me-1"></i>https://www.linkedin.com/</label>

                                                <input value="{{ old('linkedin_link') }}" name="linkedin_link"
                                                    type="url" class="form-control" placeholder="publishers">
                                                @error('linkedin_link')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="">Price per diffusion
                                            </label>
                                            <div class="input-group mb-3 align-items-center">

                                                <span class="input-group-text" id="basic-addon1">€</span>
                                                <input value="{{ old('diffusion_price') }}" name="diffusion_price"
                                                    type="number" class="form-control">
                                                @error('diffusion_price')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-12 mt-3 text-end">
                            <a href="{{ route('publishers.website') }}" class="btn btn-dark">
                                Cancel

                            </a>
                            <button type="submit" class="btn btn-success waves-effect waves-light"> Next<i
                                    class="fa fa-arrow-right ms-1"></i>
                            </button>

                        </div>

                    </div>
                </form>
            </div>

        </div>

    </div>
    {{-- Steps --}}
    <div class="col-md-2 col-sm-3 d-none d-sm-block bg-new-lighter p-0 m-0">
        <div class="lateral-aside">
            <!-- Step 1 -->
            <div class="div-paso">
                <div class="badges-pasos">
                    <div class="circle-pasos circle-activep"><i class="fa fa-check" aria-hidden="true"></i></div>
                    <div class="line-pasos-donep"></div>
                </div>
                <div class="texto-pasos">
                    <p class="p-pasos-active">Enter the URL</p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="div-paso">
                <div class="badges-pasos">
                    <div class="circle-pasos circle-activep">2</div>
                    <div class="line-pasos"></div>
                </div>
                <div class="texto-pasos">
                    <p class="p-pasos-active">Complete the data</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="div-paso">
                <div class="badges-pasos">
                    <div class="circle-pasos circle-inactive">3</div>
                    <div class="line-pasos"></div>
                </div>
                <div class="texto-pasos">
                    <p class="p-pasos">Verify your website</p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="div-paso">
                <div class="badges-pasos">
                    <div class="circle-pasos circle-inactive">4</div>
                </div>
                <div class="texto-pasos">
                    <p class="p-pasos">Finished</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('.images_per_post').select2();
        $('.Select_Country').select2();
        $('.links_per_post').select2();
        $('.links_admitted').select2();
        $('.delicated_topics').select2();
        $('.js-example-basic-multiple').select2();
    });
</script>
@endsection
