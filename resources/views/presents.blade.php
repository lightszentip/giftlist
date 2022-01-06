<x-app-layout>
    <div class="container">

        <x-slot name="header">
            <h1 class="mt-5">
                {{ __('Geschenk Liste') }}
            </h1>
        </x-slot>

        <div class="py-12" id="accordionExample">
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
                document.querySelector('input[id=gridSwitch]').addEventListener('click', function(){
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
                                    <div class="thumbnail"><img style="width: 200px"
                                            data-src="{{($present->isImageExists() ? '' : 'holder.js/200x200/?auto=yes' )}}" src="{{asset('files').'/'.$present->imagepath}}" class="img-responsive rounded">
                                    </div>
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
                                    <a data-bs-toggle="modal" class="btn btn-warning" data-bs-target="#sharePresentModalLabel_{{$present->id}}"
                                       data-action="{{ route('presents.share', $present->id) }}">  {{__('messages-page.presenttable_button_useit')}}</a>


                                    <div class="modal fade" id="sharePresentModalLabel_{{$present->id}}" data-backdrop="static" tabindex="-1" role="dialog"
                                         aria-labelledby="sharePresentModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="sharePresentModalLabel">{{__('messages-page.share_modal_title')}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('presents.share', $present->id) }}">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('POST')
                                                        <h5 class="text-center">{{__('messages-page.share_modal_text',['id'=> $present->id,'title'=>$present->title])}}</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                            {{__('messages-page.modal_share_cancel')}}</button>
                                                        <button type="submit" class="btn btn-danger">{{__('messages-page.modal_share_select')}}</button>
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

                    <div class="row accordion-body">
                        @foreach($presents as $present)
                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                    <img style="width: 200px"
                                        data-src="{{($present->isImageExists() ? '' : 'holder.js/200x200/' )}}" src="{{asset('files').'/'.$present->imagepath}}" class="img-responsive rounded">
                                    <div class="caption">
                                        <h3>{{$present->title}}</h3>
                                        <p style="word-wrap: break-word;">
                                            {{$present->shortDescription()}}
                                        </p>
                                        <p>
                                        <ul>
                                            @foreach($present->links as $link)
                                                <li>
                                                    <a href="{{$link->link}}" target="_blank">{{$link->link}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        </p>
                                        <p>
                                            <a href="{{route('presents.details',$present->id)}}"
                                               class="btn  btn-secondary  mg10bt  m-2"
                                               role="button">{{__('messages-page.presenttable_button_details')}}</a>
                                            @if ($present->status == 1)
                                            <a data-bs-toggle="modal" class="btn btn-warning" data-bs-target="#sharePresentModalLabelb_{{$present->id}}"
                                               data-action="{{ route('presents.share', $present->id) }}">  {{__('messages-page.presenttable_button_useit')}}</a>

                                        <div class="modal fade" id="sharePresentModalLabelb_{{$present->id}}" data-backdrop="static" tabindex="-1" role="dialog"
                                             aria-labelledby="sharePresentModalLabelb" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="sharePresentModalLabelb">{{__('messages-page.share_modal_title')}}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('presents.share', $present->id) }}">
                                                        <div class="modal-body">
                                                            @csrf
                                                            @method('POST')
                                                            <h5 class="text-center">{{__('messages-page.share_modal_text',['id'=> $present->id,'title'=>$present->title])}}</h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                {{__('messages-page.modal_share_cancel')}}</button>
                                                            <button type="submit" class="btn btn-danger">{{__('messages-page.modal_share_select')}}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        </p>
                                    </div>
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
    </div>
</x-app-layout>
