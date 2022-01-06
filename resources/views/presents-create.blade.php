<x-app-layout>
    <div class="container">

        <x-slot name="header">
            <h2 class="mt-5 m-5">
                {{ __('presents.create_title') }}
            </h2>
        </x-slot>

        <div class="py-12">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Dropzone -->
                <form action="{{route('uploadFile')}}" class='dropzone' ></form>
                <form action="{{ route('presents.store') }}" method="POST" class="row g-3">
                @csrf
                    <input type="hidden" id="imagepath" name="imagepath" />
                <div class="row mb-3">
                    <label for="title" class="col-sm-2 col-form-label">{{__('presents.create_form_title')}}</label>
                    <div class="col-sm-10">
                        <input type="text" id="title" required name="title"
                               class="form-control @error('title') is-invalid @enderror"
                               placeholder=""
                               value="{{ old('title') }}" maxlength="255"
                               @error('title')aria-describedby="validationServerTitle" @enderror>
                        @error('title')
                        <div id="validationServerTitle" class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="description"
                           class="col-sm-2 col-form-label">{{__('presents.create_form_description')}}</label>
                    <div class="col-sm-10">
                        <textarea rows="4" id="description" name="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder=""
                                  @error('description')aria-describedby="validationServerDescription" @enderror>{{ old('description') }}</textarea>
                        @error('description')
                        <div id="validationServerDescription" class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="links"
                           class="col-sm-2 col-form-label">{{__('presents.create_form_links')}}</label>
                    <div class="col-sm-10">
                        @forelse($present->links() as $link)
                            <div class="row linkform">
                                <div class="col-md-10">
                                    <div class="input-group col-xs-10">
                                        <input type="url" name="links[]" class="form-control"
                                               id="inputLinks{$counter+1}"
                                               placeholder="{{__("presents.form_label_links")}}" value=""/>
                                        @if ( $loop->index > 0)
                                            <span class="input-group-btn"><button class="btn btn-danger removeLink"
                                                                                  type="button">{{__("presents.form_button_remove_link")}}
                                    </button>
                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="row linkform">
                                <div class="col-md-10 col-xs-10"><input type="url" name="links[]" class="form-control"
                                                                        id="inputLinks1"
                                                                        placeholder="{{__("presents.form_label_links")}}"
                                                                        value=""/></div>
                            </div>
                        @endforelse
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button id="addLink" type="button" class=" btn btn-success">
                                {{__("presents.form_button_add_link")}}
                            </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <script type="text/javascript" defer>
        $(document).ready(function() {
            //create three initial fields
            var varCount = {{ count($present->links)}};
            //remove a textfield
            $('form').on('click', '.removeLink', function () {
                $(this).parent().parent().parent().parent().remove();
            });
            //add a new node
            $('#addLink').on('click', function () {
                varCount++;
                $node = '<div class="row linkform"><div class="col-md-10">' +
                    '<div class="input-group col-xs-10">' +
                    '<input type="url" name="links[]" class="form-control" id="inputLinks' + varCount + '" placeholder="{{__("presents.form_label_links")}}" />' +
                    '<span class="input-group-btn">' +
                    '<button class="btn btn-danger removeLink" type="button">' +
                    '{{__("presents.form_button_remove_link")}}' +
                    '</button></span></div></div></div>';
                $(".linkform").last().after($node);
            });
        });
    </script>
    <script>
        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone(".dropzone",{
            maxFilesize: 5, // 2 mb
            maxFiles: 1,
            acceptedFiles: ".jpeg,.jpg,.png,.pdf,.svg",
            addRemoveLinks: true,
        });
        myDropzone.on("sending", function(file, xhr, formData) {
            formData.append("_token", CSRF_TOKEN);
        });
        myDropzone.on("success", function(file, response) {

            if(response.success == 0){ // Error
                alert(response.error);
            } else if(response.success == 1) {
                $('#imagepath').val(response.link);
            }

        });
    </script>
</x-app-layout>
