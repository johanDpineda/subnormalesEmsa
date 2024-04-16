<div>
    <!-- Notification -->
    <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
            data-bs-auto-close="outside" aria-expanded="false">
            @livewire('wordkin.notificacioneslist')





        </a>
        <ul class="dropdown-menu dropdown-menu-end py-0">
            <li class="dropdown-menu-header border-bottom">
                <div class="dropdown-header d-flex align-items-center py-3">
                    <h5 class="text-body mb-0 me-auto">{{__('notification')}}</h5>
                </div>
            </li>
            <li class="dropdown-notifications-list scrollable-container">
                <ul class="list-group list-group-flush">
                    <!-- Livewire Component Here -->
                    @foreach($notificationdatacaminante as $notification)
                        <li class="list-group-item list-group-item-action dropdown-notifications-item">
                            <a href="{{route('Caminantes.index')}}" style="display: contents;color: black;">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                    <h6 class="mb-1">Nueva Zona Subnormal Encontrada</h6>
                                    <p class="mb-0" style="font-weight: 900">Nombre Del Lider: </p> <span>{{$notification->name}}</span>
                                    <p class="mb-0" style="font-weight: 900">Latitud: </p> <span> {{$notification->latitude}}</span>
                                    <p class="mb-0" style="font-weight: 900">Longitud: </p> <span>{{$notification->longitude}}</span>
                                    <p class="mb-0" style="font-weight: 900">Caminante: </p> <span>{{$notification->user->name}}</span>
                                    <br>
                                    <small class="text-muted line-break">{{$notification->created_at}}</small>
                                    </div>
                                    <div style="width: 250px; height: 200px;margin-right: 10px;">
                                        <iframe src='https://www.google.com/maps?q={{ $notification->latitude ?? "" }},{{ $notification->longitude ?? "" }}&hl=es;z=14&output=embed' frameborder="0" width="100%" height="100%"></iframe>
                                    </div>
                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                        <a href="javascript:void(0)" onclick="marcarNotificacionYRecargarcaminante({{ $notification->id }})"
                                        class="dropdown-notifications-read @if(in_array($notification->id, $notificacionesLeidas)) notificacion-leida @endif"
                                        wire:click="marcarNotificacionComoLeidadatoscamiante({{ $notification->id }})"
                                        @if(in_array($notification->id, $notificacionesLeidas)) disabled @endif
                                        >
                                            @if(in_array($notification->id, $notificacionesLeidas))
                                                <i class="fas fa-check-circle text-success"></i> <!-- Icono para indicar que la notificación ha sido leída -->
                                            @else
                                                <i class="far fa-circle text-primary"></i> <!-- Icono por defecto -->
                                            @endif
                                        </a>

                                    </div>

                                </div>
                            </a>
                        </li>
                    @endforeach

                    @foreach($notificationcontrolterreno as $notificationcontrolterrenot)
                        <li class="list-group-item list-group-item-action dropdown-notifications-item">
                            <a href="{{route('controlTerrenos.index')}}" style="display: contents;color: black;">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                    <h6 class="mb-1">Generacion del codigo para el MacroMedidor</h6>
                                    <p class="mb-0" style="font-weight: 900">Nombre Del Lider: </p> <span>{{$notificationcontrolterrenot->Datoscaminante->name}}</span>
                                    <p class="mb-0" style="font-weight: 900">Latitud: </p> <span>{{$notificationcontrolterrenot->Datoscaminante->latitude}}</span>
                                    <p class="mb-0" style="font-weight: 900">Longitud: </p> <span>{{$notificationcontrolterrenot->Datoscaminante->longitude}}</span>
                                    <p class="mb-0" style="font-weight: 900">Codigo: </p> <span>{{$notificationcontrolterrenot->code_macromedidor}}</span>
                                    <br>
                                    <small class="text-muted">{{$notificationcontrolterrenot->created_at}}</small>
                                    </div>
                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                        <a href="javascript:void(0)" onclick="marcarNotificacionYRecargarmacro({{ $notificationcontrolterrenot->id }})"
                                        class="dropdown-notifications-read @if(in_array($notificationcontrolterrenot->id, $notificacionesLeidascontrolterreno)) notificacion-leida @endif"
                                        wire:click="marcarNotificacionComoLeidacodemacro({{ $notificationcontrolterrenot->id }})"
                                        @if(in_array($notificationcontrolterrenot->id, $notificacionesLeidascontrolterreno)) disabled @endif
                                        >
                                            @if(in_array($notificationcontrolterrenot->id, $notificacionesLeidascontrolterreno))
                                                <i class="fas fa-check-circle text-success"></i> <!-- Icono para indicar que la notificación ha sido leída -->
                                            @else
                                                <i class="far fa-circle text-primary"></i> <!-- Icono por defecto -->
                                            @endif
                                        </a>

                                    </div>
                                        <!-- Aquí colocamos el mapa de Google dentro de un div -->
                                        <div style="width: 250px; height: 200px;">
                                            <iframe src='https://www.google.com/maps?q={{ $notificationcontrolterrenot->Datoscaminante->latitude ?? "" }},{{ $notificationcontrolterrenot->Datoscaminante->longitude ?? "" }}&hl=es;z=14&output=embed' frameborder="0" width="100%" height="100%"></iframe>
                                        </div>
                                </div>
                            </a>

                        </li>
                    @endforeach

                    @foreach($notificationcrearsubnormal as $notificationcrearsubnormals)
                        <li class="list-group-item list-group-item-action dropdown-notifications-item">
                            <a href="{{route('CrearSubNormal.index')}}" style="display: contents;color: black;">

                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                    <h6 class="mb-1">Generacion de una nueva Zona Subnormal</h6>
                                    <p class="mb-0">Nombre Del Sector: {{$notificationcrearsubnormals->sector_name}}</p>
                                    <p class="mb-0">Codigo del Macromedidor: {{$notificationcrearsubnormals->controlterreno->code_macromedidor}}</p>
                                    <p class="mb-0">Nombre Del Lider: {{$notificationcrearsubnormals->controlterreno->Datoscaminante->name}}</p>
                                    <p class="mb-0">Telefono del Lider: {{$notificationcrearsubnormals->phone}}</p>
                                    <small class="text-muted">{{$notificationcrearsubnormals->created_at}}</small>
                                    </div>
                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                        <a href="javascript:void(0)" onclick="marcarNotificacionYRecargarnewsubnormal({{$notificationcrearsubnormals->id}})"
                                        class="dropdown-notifications-read @if(in_array($notificationcrearsubnormals->id, $notificacionesLeidascrearsubnormal)) notificacion-leida @endif"
                                        wire:click="marcarNotificacionComoLeidanewsubnormal({{ $notificationcrearsubnormals->id }})"
                                        @if(in_array($notificationcrearsubnormals->id, $notificacionesLeidascrearsubnormal)) disabled @endif
                                    >
                                        @if(in_array($notificationcrearsubnormals->id, $notificacionesLeidascrearsubnormal))
                                            <i class="fas fa-check-circle text-success"></i> <!-- Icono para indicar que la notificación ha sido leída -->
                                        @else
                                            <i class="far fa-circle text-primary"></i> <!-- Icono por defecto -->
                                        @endif
                                    </a>

                                    </div>
                                </div>

                            </a>
                        </li>
                    @endforeach

                    @foreach($notificationdocumentsexits as $notificationdocumentsexit)
                        <li class="list-group-item list-group-item-action dropdown-notifications-item">

                            <a href="{{route('CrearSubNormal.index')}}" style="display: contents;color: black;">

                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                    <h6 class="mb-1">Documentos cargados con exito, Realizar proceso de codigo para la factura</h6>
                                    <p class="mb-0">Nombre Del Sector: {{$notificationdocumentsexit->newdocumentoacuerdoemsa->sector_name}}</p>
                                    <p class="mb-0">Codigo del Macromedidor: {{$notificationdocumentsexit->newdocumentoacuerdoemsa->controlterreno->code_macromedidor}}</p>
                                    <p class="mb-0">Nombre Del Lider: {{$notificationdocumentsexit->newdocumentoacuerdoemsa->controlterreno->Datoscaminante->name}}</p>
                                    <p class="mb-0">Telefono del Lider: {{$notificationdocumentsexit->newdocumentoacuerdoemsa->phone}}</p>
                                    <small class="text-muted">{{$notificationdocumentsexit->created_at}}</small>
                                    </div>
                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                        <a href="javascript:void(0)" onclick="marcarNotificacionYRecargardocuments({{$notificationdocumentsexit->id}})"
                                        class="dropdown-notifications-read @if(in_array($notificationdocumentsexit->id, $notificacionesLeidasdocumentsexits)) notificacion-leida @endif"
                                        wire:click="marcarNotificacionComoLeidagenerationdocuments({{ $notificationdocumentsexit->id }})"
                                        @if(in_array($notificationdocumentsexit->id, $notificacionesLeidasdocumentsexits)) disabled @endif
                                    >
                                        @if(in_array($notificationdocumentsexit->id, $notificacionesLeidasdocumentsexits))
                                            <i class="fas fa-check-circle text-success"></i> <!-- Icono para indicar que la notificación ha sido leída -->
                                        @else
                                            <i class="far fa-circle text-primary"></i> <!-- Icono por defecto -->
                                        @endif
                                    </a>




                                    </div>
                                </div>

                            </a>
                        </li>
                    @endforeach

                    @foreach($notificationcrearcodefactura as $notificationcrearcodefacturas)
                        <li class="list-group-item list-group-item-action dropdown-notifications-item">
                            <a href="{{route('CrearSubNormal.index')}}" style="display: contents;color: black;">

                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                    <h6 class="mb-1">Generacion de Codigo para la factura un sector Subnormal</h6>
                                    <p class="mb-0">Nombre Del Sector: {{$notificationcrearcodefacturas->zonassubnormales->sector_name}}</p>
                                    <p class="mb-0">Codigo del Macromedidor: {{$notificationcrearcodefacturas->zonassubnormales->controlterreno->code_macromedidor}}</p>
                                    <p class="mb-0">Nombre Del Lider: {{$notificationcrearcodefacturas->zonassubnormales->controlterreno->Datoscaminante->name}}</p>
                                    <p class="mb-0">Telefono del Lider: {{$notificationcrearcodefacturas->zonassubnormales->phone}}</p>
                                    <p class="mb-0">Codigo de Factura: {{$notificationcrearcodefacturas->invoice_code}}</p>
                                    <small class="text-muted">{{$notificationcrearcodefacturas->created_at}}</small>
                                    </div>
                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                        <a href="javascript:void(0)" onclick="marcarNotificacionYRecargarfactura({{$notificationcrearcodefacturas->id}})"
                                        class="dropdown-notifications-read @if(in_array($notificationcrearcodefacturas->id, $notificacionesLeidascodefactura)) notificacion-leida @endif"
                                        wire:click="marcarNotificacionComoLeidagenerationcodefactura({{ $notificationcrearcodefacturas->id }})"
                                        @if(in_array($notificationcrearcodefacturas->id, $notificacionesLeidascodefactura)) disabled @endif
                                    >
                                        @if(in_array($notificationcrearcodefacturas->id, $notificacionesLeidascodefactura))
                                            <i class="fas fa-check-circle text-success"></i> <!-- Icono para indicar que la notificación ha sido leída -->
                                        @else
                                            <i class="far fa-circle text-primary"></i> <!-- Icono por defecto -->
                                        @endif
                                    </a>




                                    </div>
                                </div>

                            </a>

                        </li>
                    @endforeach
                </ul>
            </li>

        </ul>
    </li>
    <!--/ Notification -->

</div>


