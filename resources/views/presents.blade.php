<x-app-layout>
    <div class="container">

        <x-slot name="header">
            <h1 class="mt-5">
                {{ __('Geschenk Liste') }}
            </h1>
        </x-slot>

        <div class="py-12">
            @if ($view == 'list')
            <table class="table table-striped table-hove" id="sortTableExample">
                <thead>
                <tr>
                    <th data-sorter="false">{$messageResolver->getMessage("presenttable_image")}</th>
                    <th>{$messageResolver->getMessage("presenttable_title")}</th>
                    <th data-sorter="false">{$messageResolver->getMessage("presenttable_description")}</th>
                    <th data-sorter="false">{$messageResolver->getMessage("presenttable_links")}</th>
                    <th class="col-sm-2" data-sorter="false"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($presents as $present)
                <tr>
                    <td>
                        <div class="thumbnail"><img data-src="{function="{{($present->isImageExists() ? '' : 'holder.js/200x200/' )}}"}" src="{{$present->imagepath}}" class="img-responsive">
                        </div></td>
                    <td>{{$present->shortDescription()}}</td>
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
                    <td >
                        <button type="button" id="#fooo{$value->getId()}" class="mg10bt btn btn-default btn shareModalButton mg10bt" data-id="{$value->getId()}" data-toggle="modal" data-target="#shareModal">
                            <span class="glyphicon glyphicon-share-alt"></span> {$messageResolver->getMessage("presenttable_share")}
                        </button>
                        <a href="index.php?mapping=present/view&presentId={$value->getId()}" class="btn btn-default mg10bt" role="button">{$messageResolver->getMessage("presenttable_button_details")}</a>
                        <button class="btn btn-primary usePresentModalButton mg10bt" data-toggle="modal" data-id="{$value->getId()}"  data-target="#usePresentModal">
                            {$messageResolver->getMessage("presenttable_button_useit")}
                        </button>

                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @else
            <div class="row">
                @foreach($presents as $present)
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img data-src="{function="{{($present->isImageExists() ? '' : 'holder.js/200x200/' )}}"}" src="{{$present->imagepath}}" class="img-responsive">
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
                                <button type="button" id="#fooo{$value->getId()}" class="btn btn-default btn shareModalButton" data-id="{$value->getId()}" data-toggle="modal" data-target="#shareModal">
                                    <span class="glyphicon glyphicon-share-alt"></span> {$messageResolver->getMessage("presenttable_share")}
                                </button>
                                <button class="btn btn-primary usePresentModalButton" data-toggle="modal" data-id="{$value->getId()}"  data-target="#usePresentModal">
                                    {$messageResolver->getMessage("presenttable_button_useit")}
                                </button>
                                <a href="index.php?mapping=present/view&presentId={$value->getId()}" class="btn btn-default" role="button">{$messageResolver->getMessage("presenttable_button_details")}</a>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
