@extends('admin::base')
@section('title-right')
    {!! Html::link(
      admin_route('content.roots.posts.create', [$root->slug]),
      trans('admin::default.actions.create'),
      ['class' => 'btn btn-success'])
    !!}
@endsection
@section('content')
    <div class="wrapper-md" ng-controller="PostsIndexCtrl">
        <div class="panel panel-default">
            <div class="row wrapper">
                <div class="col-sm-4 hidden-xs js__disabledManipulation">
                    <select class="input-sm form-control w-sm inline v-middle">
                        <option value="delete">Delete selected</option>
                    </select>
                    <button data-action="batchAction" data-url="{{ $batchAction }}" class="btn btn-sm btn-default apply_bulk">Apply</button>
                </div>
            </div>
            <div class="table-responsive" >
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th><label  class="i-checks m-b-none js-check-checkbox"><input onchange="applyBulkCheck($(this))" type="checkbox"><i></i></label></th>
                        <th>{{ trans('content::default.posts.id') }}</th>
                        <th>Имя</th>
                        <th>Телефон</th>
                        <th>Название</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="v-middle" style="width:20px;">
                                <label class="i-checks m-b-none js-check-checkbox active"><input type="checkbox" data-value="{{$order->id}}"><i></i></label>
                            </td>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->product->title }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="alert alert-danger">
                                    {{ trans('content::default.posts.empty') }}
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-sm-4 hidden-xs js__disabledManipulation">
                        <select class="input-sm form-control w-sm inline v-middle">
                            <option value="delete">Delete selected</option>
                        </select>
                        <button data-action="batchAction" data-url="{{ $batchAction }}" class="btn btn-sm btn-default apply_bulk">Apply</button>
                    </div>
                    <div class="col-sm-8"></div>
                    <div class="col-sm-4 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            {{--{!! $briefs->render() !!}--}}
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection