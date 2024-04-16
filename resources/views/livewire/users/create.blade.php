<div>
    <div wire:ignore.self  class="modal fade" id="create"  tabindex="-1" aria-labelledby="exampleModalLabel" style="" aria-hidden="true" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-simple ">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeAndClean"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">{{__('Add User')}}</h3>
                        <p class="text-muted">{{__('Complete the information to add a new user')}}</p>
                    </div>
                    <form class="row g-3" wire:submit.prevent="save" id="formAuthentication">
                        <div class="col-12">
                            <label class="form-label" for="image">{{__('Image')}}</label>
                            <div class="image-upload">
                                <div class="thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview"
                                            @if($image)
                                                 style="background: url('{{$image->temporaryUrl()}}')"
                                            @endif>
                                            <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" class="profilePicUpload" wire:model="image" id="image_create" name="" accept=".png, .jpg, .jpeg">
                                        <label for="image_create" class="bg--primary">{{__('Add Image')}}</label>
                                        <small class="mt-2">{{__('Compatibilities')}}: <b>jpeg, jpg, png</b>| {{__('Resized to')}}: <b>100x100</b>px.
                                        </small>
                                    </div>
                                </div>
                            </div>
                            @error('image')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="name">{{__('Name')}}:</label>
                            <input type="text" id="name" class="form-control" placeholder="" name="name" aria-label="" wire:model.defer="name" />
                            @error('name')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="email">{{__('Email')}}:</label>
                            <input type="email" id="email" class="form-control" placeholder="" name="email" aria-label="" wire:model.defer="email" />
                            @error('email')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="form-password-toggle col-12">
                            <label class="form-label" for="password">{{__('Password')}}:</label>
                            <div class="input-group input-group-merge">
                                <input id="password" type="password" class="form-control" name="password"
                                   placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                   aria-describedby="password" wire:model.defer="password"
                                   autocomplete="current-password"
                                >
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                @error('password')
                                <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 select-user">
                            <label class="form-label" for="role">{{__('Role')}}</label>
                            <select id="role" name="role" wire:model.defer="role" class="select2 form-select single-select" data-placeholder="{{__('Select a role')}}...">
                                <option></option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary me-sm-3 me-1" wire:loading.class="disabled" wire:loading.attr="disabled" wire:target="save" wire:click='save'>
                                {{__('Save')}}</button>
                            <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close" wire:click="closeAndClean">
                                {{__('Cancel')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}" defer></script>
        <script>
            $(function () {
                window.initUsersCreate=()=>{
                    // Select2
                    $('.select-user .single-select').select2({
                        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                        dropdownParent: $('.select-user')
                    });
                }
                $('.select-user .single-select').on('change', function (e) {
                    livewire.emit('usersCreateChange', $(this).val(), $(this).attr('wire:model.defer'));
                });

                window.livewire.on('usersCreateHydrate',()=>{
                    initUsersCreate();
                });
                livewire.emit('usersCreateChange', '', '');
            });
        </script>
</div>
