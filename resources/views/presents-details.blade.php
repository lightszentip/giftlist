<x-app-layout>
    <div class="container">

        <x-slot name="header">
            <h2 class="mt-5 m-5">
                {{ __('presents.details_title',['title' => $present->title, 'id' => $present->id]) }}
            </h2>
        </x-slot>

        <div class="py-12">

                <div class="row mb-3">
                    <label for="title" class="col-sm-2 col-form-label">{{__('presents.create_form_title')}}</label>
                    <div class="col-sm-10">
                        {{$present->title }}
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="description"
                           class="col-sm-2 col-form-label">{{__('presents.create_form_description')}}</label>
                    <div class="col-sm-10">
                        {{$present->description }}
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="links"
                           class="col-sm-2 col-form-label">{{__('presents.create_form_links')}}</label>
                    <div class="col-sm-10">
                        @foreach($present->links as $link)
                            <div class="row linkform">
                                <div class="col-md-10">
                                    <div class="input-group col-xs-10">
                                        {{$link->link}}

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                    <div class="row mb-3">
                        <label for="title" class="col-sm-2 col-form-label">{{__('presents.create_form_imagepath')}}</label>
                        <div class="col-sm-10">
                                <img style="width: 200px" id="previewImagePresent"
                                     data-src="{{($present->isImageExists() ? '' : 'holder.js/200x200/?auto=yes' )}}" src="{{asset('files').'/'.$present->imagepath}}" class="img-responsive rounded">
                        </div>
                    </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <a href="{{ route('presents.show') }}" class="btn btn-primary m-2">
                            {{__('messages-page.back')}}
                        </a>
                    </div>

                </div>

            </form>
        </div>
    </div>
</x-app-layout>
