<x-app-layout>
    <div class="container">

        <x-slot name="header">
            <h1 class="mt-5">
                {{ __('Geschenk Liste') }}
            </h1>
        </x-slot>

        <div class="py-12 mb-5" id="accordionExample">
            @if($presents->count()>0)
                <div class="nav-item text-nowrap form-check form-switch">
                    <label class="form-check-label" for="gridSwitch">
                        GRID
                    </label>
                    <input class="form-check-input"
                           type="checkbox" id="gridSwitch" {{$view == 'list' ? '' : "checked"}}
                           data-bs-toggle="collapse"
                           data-bs-target="#panelsStayOpen-collapseGrid"
                           aria-expanded="{{$view == 'list' ? 'false' : 'true'}}"
                           aria-controls="panelsStayOpen-collapseGrid"/>

                </div>
                <script>
                    document.querySelector('input[id=gridSwitch]').addEventListener('click', function () {
                        if (!this.checked) {
                            document.querySelector('div[id=panelsStayOpen-collapseOne]').className = "accordion-collapse collapse show";
                        } else {
                            document.querySelector('div[id=panelsStayOpen-collapseOne]').className = "accordion-collapse collapse";
                        }
                    });

                </script>

                <div id="panelsStayOpen-collapseOne"
                     class="accordion-collapse collapse {{$view == 'list' ? 'show' : ''}}"
                     data-bs-parent="#accordionExample"
                     aria-labelledby="panelsStayOpen-headingOne">
                    <table class="table table-striped table-light table-hove accordion-body" id="sortTableExample">
                        <thead>
                        <tr>
                            <th data-sorter="false">{{__('messages-page.presenttable_image')}}</th>
                            <th>{{__('messages-page.presenttable_title')}}</th>
                            <th data-sorter="false">{{__('messages-page.presenttable_description')}}</th>
                            <th data-sorter="false">{{__('messages-page.presenttable_links')}}</th>
                            <th class="col-sm-2" data-sorter="false"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($presents as $present)
                            <tr>
                                <td>


                                    <div class="thumbnail">
                                        <img style="width: 200px"
                                             data-src="{{($present->isImageExists() ? '' : 'holder.js/200x200/?auto=yes' )}}"
                                             src="{{asset('files').'/'.$present->imagepath}}"
                                             class="img-responsive rounded">
                                    </div>
                                    @if ($present->status == 2)
                                        <span class="ribbon5" style="width: 200px">Schon gewählt</span>
                                    @endif


                                </td>
                                <td>{{$present->title}}</td>
                                <td>{{$present->shortDescription()}}</td>
                                <td>
                                    <ul>
                                        @foreach($present->links as $link)
                                            <li>
                                                <a href="{{$link->link}}" target="_blank">{{$link->link}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <a href="{{route('presents.details',$present->id)}}"
                                       class="btn  btn-secondary  mg10bt  m-2"
                                       role="button">{{__('messages-page.presenttable_button_details')}}</a>
                                    @if ($present->status == 1)
                                        <a data-bs-toggle="modal" class="btn btn-warning"
                                           data-bs-target="#sharePresentModalLabel_{{$present->id}}"
                                           data-action="{{ route('presents.share', $present->id) }}">  {{__('messages-page.presenttable_button_useit')}}</a>


                                        <div class="modal fade" id="sharePresentModalLabel_{{$present->id}}"
                                             data-backdrop="static" tabindex="-1" role="dialog"
                                             aria-labelledby="sharePresentModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="sharePresentModalLabel">{{__('messages-page.share_modal_title')}}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <form method="GET"
                                                          action="{{ route('presents.share', $present->id) }}">
                                                        <div class="modal-body">
                                                            @csrf
                                                            <h5 class="text-center">{{__('messages-page.share_modal_text',['id'=> $present->id,'title'=>$present->title])}}</h5>
                                                            <div class="col-sm-10">
                                                                <input type="text" id="codeText" required
                                                                       name="codeText"
                                                                       class="form-control"
                                                                       placeholder="{{__('messages-page.share_modal_input')}}"
                                                                       maxlength="255">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                {{__('messages-page.modal_share_cancel')}}</button>
                                                            <button type="submit"
                                                                    class="btn btn-danger">{{__('messages-page.modal_share_select')}}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="panelsStayOpen-collapseGrid"
                     class="accordion-collapse collapse {{$view == 'list' ? '' : 'show'}}"
                     data-bs-parent="#accordionExample"
                     aria-labelledby="panelsStayOpen-headingGrid">

                    <div class="row row-cols-1 row-cols-md-5 g-5">
                        @foreach($presents as $present)
                            <div class="col">
                                <div class="card-sl">
                                    <div class="card-image">
                                        @if ($present->status == 2)
                                            <span class="ribbon6" style="width: 200px">Schon gewählt</span>
                                        @endif
                                        <img style="width: 200px"
                                             data-src="{{($present->isImageExists() ? '' : 'holder.js/200x200/' )}}"
                                             src="{{asset('files').'/'.$present->imagepath}}"
                                             class="img-responsive rounded">

                                    </div>
                                    @if ($present->status == 1)
                                        <a data-bs-toggle="modal" class="card-action"
                                           data-bs-target="#sharePresentModalLabelb_{{$present->id}}"
                                           data-action="{{ route('presents.share', $present->id) }}"> <i
                                                class="bi bi-bag-plus"></i> {{__('messages-page.presenttable_button_useit')}}
                                        </a>
                                    @endif
                                    <div class="card-heading">
                                        {{$present->title}}
                                    </div>
                                    <div class="card-text">
                                        {{$present->shortDescription()}}
                                    </div>
                                    <div class="card-text">


                                        <ul>
                                            @foreach($present->links as $link)
                                                <li>
                                                    <a href="{{$link->link}}" target="_blank">{{$link->link}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <a href="{{route('presents.details',$present->id)}}"
                                       class="card-button"
                                       role="button">{{__('messages-page.presenttable_button_details')}}</a>
                                    @if ($present->status == 1)

                                        <div class="modal fade" id="sharePresentModalLabelb_{{$present->id}}"
                                             data-backdrop="static" tabindex="-1" role="dialog"
                                             aria-labelledby="sharePresentModalLabelb" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="sharePresentModalLabelb">{{__('messages-page.share_modal_title')}}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <form method="GET"
                                                          action="{{ route('presents.share', $present->id) }}">
                                                        <div class="modal-body">
                                                            @csrf
                                                            <h5 class="text-center">{{__('messages-page.share_modal_text',['id'=> $present->id,'title'=>$present->title])}}</h5>
                                                            <div class="col-sm-10">
                                                                <input type="text" id="codeText" required
                                                                       name="codeText"
                                                                       class="form-control"
                                                                       placeholder="{{__('messages-page.share_modal_input')}}"
                                                                       maxlength="255">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                {{__('messages-page.modal_share_cancel')}}</button>
                                                            <button type="submit"
                                                                    class="btn btn-danger">{{__('messages-page.modal_share_select')}}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="alert alert-warning" role="alert">
                    {{__('messages-page.no_data')}}
                </div>

            @endif

        </div>
        <div class="row mt-10 pt-8">
            <a data-bs-toggle="modal" class="btn btn-warning" data-bs-target="#resetUserPresentModalLabelb"
               data-action="{{ route('presents.resetUser') }}">  {{__('messages-page.presenttable_button_resetit')}}</a>

            <div class="modal fade" id="resetUserPresentModalLabelb" data-backdrop="static" tabindex="-1"
                 role="dialog"
                 aria-labelledby="resetPresentModalLabelb" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"
                                id="resetPresentModalLabelb">{{__('messages-page.reset_modal_title')}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{ route('presents.resetUser') }}" action="POST">
                            <div class="modal-body">
                                @csrf
                                @method('POST')
                                <h5 class="text-center">{{__('messages-page.reset_modal_text_user')}}</h5>
                                <div class="col-sm-10">
                                    <input type="text" id="codeText" required name="resetCode"
                                           class="form-control"
                                           placeholder="{{__('messages-page.reset_modal_input')}}"
                                           maxlength="255">


                                </div>
                                @if(config('app.presentlist_code') != 'CODE')
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Geschenk" id="presentId"
                                                name="presentId">
                                            <option selected>Geschenk wählen zum Code</option>
                                            @foreach($presentsReset as $resetPResent)
                                                <option
                                                    value="{{$resetPResent->id}}">{{$resetPResent->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    {{__('messages-page.modal_reset_cancel')}}</button>
                                <button type="submit"
                                        class="btn btn-danger">{{__('messages-page.modal_reset_select')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
