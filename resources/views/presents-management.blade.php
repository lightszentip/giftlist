<x-app-layout>
    <div class="container">

        <x-slot name="header">
            <h1 class="mt-5">
                {{ __('Geschenk Liste') }}
            </h1>
        </x-slot>

        <div class="py-12" id="accordionExample">
            @if($presents->count()>0)

                    <table class="table table-striped table-light table-hove accordion-body" id="sortTableExample">
                        <thead>
                        <tr>
                            <th data-sorter="false">{{__('messages-page.presenttable_image')}}</th>
                            <th>{{__('messages-page.presenttable_title')}}</th>
                            <th data-sorter="false">{{__('messages-page.presenttable_description')}}</th>
                            <th data-sorter="false">{{__('messages-page.presenttable_links')}}</th>
                            <th data-sorter="false">{{__('messages-page.presenttable_status')}}</th>
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
                                <td>{{$present->description}}</td>
                                <td>
                                    <ul>
                                        @foreach($present->links as $link)
                                            <li>
                                                <a href="{{$link->link}}" target="_blank">{{$link->link}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{$present->statusAsText()}}</td>
                                <td>


                                    <a href="{{route('presents.edit',$present->id)}}"
                                       class="btn  btn-secondary  mg10bt  m-2"
                                       role="button"><i class="bi bi-ticket-detailed"></i> {{__('messages-page.presenttable_button_edit')}}</a>
                                    @if ($present->status == 0)
                                    <a href="{{route('presents.release',$present->id)}}"
                                       class="btn  btn-secondary  mg10bt  m-2"
                                       role="button"><i class="bi bi-clipboard-check"></i> {{__('messages-page.presenttable_button_release')}}</a>
                                    @endif
                                    @if ($present->status == 1)
                                        <a href="{{route('presents.draft',$present->id)}}"
                                           class="btn  btn-secondary  mg10bt  m-2"
                                           role="button"><i class="bi bi-clipboard-check"></i> {{__('messages-page.presenttable_button_draft')}}</a>
                                    @endif
                                    <a data-bs-toggle="modal" class="btn btn-warning" data-bs-target="#deletePresentModalLabel_{{$present->id}}"
                                       data-action="{{ route('presents.delete', $present->id) }}"><i class="bi bi-trash">{{__('messages-page.presenttable_button_delete')}}</i></a>
                                    <div class="modal fade" id="deletePresentModalLabel_{{$present->id}}" data-backdrop="static" tabindex="-1" role="dialog"
                                         aria-labelledby="deletePresentModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deletePresentModalLabel">{{__('messages-page.delete_modal_title')}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('presents.delete', $present->id) }}">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('DELETE')
                                                        <h5 class="text-center">{{__('messages-page.delete_modal_text',['id'=> $present->id,'title'=>$present->title])}}</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                            {{__('messages-page.modal_delete_cancel')}}</button>
                                                        <button type="submit" class="btn btn-danger">{{__('messages-page.modal_delete_delete')}}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

            @else
                <div class="alert alert-warning" role="alert">
                    {{__('messages-page.no_data')}}
                </div>

            @endif
        </div>
    </div>
</x-app-layout>
