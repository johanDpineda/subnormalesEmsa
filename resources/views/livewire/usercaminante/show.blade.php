<div wire:init="readyToLoad">
    <div wire:ignore.self class="card" id="show">
        <div class="card-datatable table-responsive pt-0">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header flex-column flex-md-row">
                    <div class="head-label text-center">
                        <h5 class="card-title mb-0">{{__('list of walkers')}}</h5>
                    </div>
                    <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class="dt-buttons btn-group flex-wrap">
                            <button class="dt-button add-new btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
                                <span>
                                  <i class="ti ti-plus me-0 me-sm-1"></i>
                                  <span class="d-sm-inline-block">{{__('Add Walker')}}</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="me-3">
                            @if($readyToLoad)
                                @if($users->total()>10)
                                    <div class="dataTables_length" id="DataTables_Table_0_length">
                                        <label>
                                            {{__('Show')}}
                                            <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select" wire:model="cant">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                @if($users->total()>25)
                                                    <option value="50">50</option>
                                                @endif
                                                @if($users->total()>50)
                                                    <option value="100">100</option>
                                                @endif
                                            </select>
                                            {{__('entries')}}
                                        </label>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                        <div class="dataTables_filter px-2">
                            <label for="">
                                {{__('Search')}}:
                                <input type="search" name="query" wire:model="query" class="form-control">
                            </label>
                        </div>
                    </div>
                </div>
                <div  style="overflow-y: auto;">
                    <table class="table">
                        <thead class="border-top">
                            <tr>
                                <th class="text-center">{{__('Image')}}</th>
                                <th class="text-center">{{__('Name')}}</th>
                                <th class="text-center">{{__('Email')}}</th>
                                <th class="text-center">{{__('Role')}}</th>
                                <th class="text-center">{{__('Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="text-center">
                                    @if($user->image!=null)
                                        <div class="avatar-wrapper d-flex justify-content-center">
                                            <div class="avatar avatar-lg p-2 ">
                                                <img src="{{asset('uploads/users/'.$user->image)}}" alt="Avatar" class="">
                                            </div>
                                        </div>
                                    @else
                                        <div class="avatar-wrapper d-flex justify-content-center">
                                            <div class="avatar avatar-lg">
                                                <span class="avatar-initial rounded-circle bg-label-primary">{{$user->name[0]}}</span>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center">{{$user->name}}</td>
                                <td class="text-center">{{$user->email}}</td>
                                @foreach($user->roles as $role)
                                    <td class="text-center">{{$role->name}}</td>
                                @endforeach
                                <td class="text-center">
                                    <div class="d-inline-block text-nowrap">
                                        <button class="btn btn-sm btn-icon edit-record" data-bs-toggle="modal" data-bs-target="#edit" wire:click="edit({{$user}})" title="Editar">
                                            <i class="ti ti-edit"></i>
                                        </button>
                                        {{--<button class="btn btn-sm btn-icon delete-record" data-id="2">
                                            <i class="ti ti-trash"></i>
                                        </button>--}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="odd">
                                <td valign="top" colspan="12" class="dataTables_empty text-center">{{$readyToLoad?__('No Walker registered'):__('Loading...')}}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($readyToLoad)
                    @if($users->total()!=0)
                        <div class="row mx-2 my-3">
                            <div class="col-md-5">
                                <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                    {{__('Showing')}} {{ $users->firstItem() }} {{__('to')}} {{ $users->lastItem() }} {{__('of')}} {{ $users->total() }} {{__('results')}}
                                </div>
                            </div>
                            <div class="col-md-7 d-flex justify-content-end">
                                @if ($users->hasPages())
                                    {{$users->links('vendor.livewire.bootstrap')}}
                                @endif
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
    @include('userscaminantes.edit')
</div>
