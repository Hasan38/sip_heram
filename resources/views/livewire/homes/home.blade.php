<div>
    <div class="row mb-2">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <form class="form-inline">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control flip" id="flip" wire:model="month"
                                    autocomplete="off" data-provide="datepicker" data-date-format="mm-yyyy"
                                    onchange="this.dispatchEvent(new InputEvent('input'))"
                                    data-date-min-view-mode="1" />
                                <div class="input-group-append">
                                    <span class="input-group-text bg-secondary border-secondary text-white">
                                        <i class="mdi mdi-calendar-range"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <a href="javascript: void(0);" class="btn btn-secondary btn-sm ml-2">
                            <i class="mdi mdi-autorenew"></i>
                        </a>
                        <a href="javascript: void(0);" class="btn btn-secondary btn-sm ml-1">
                            <i class="mdi mdi-filter-variant"></i>
                        </a>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($sum as $item)

        <div class="col-md-6 col-xl-3">
            <div class="card-box">
                <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom"
                    title="" data-original-title="More Info"></i>
                <h4 class="mt-0 font-16">{{$item->kelurahans->nama_kelurahan}}</h4>
                <h2 class="text-primary my-3 text-center"><span
                        data-plugin="counterup">{{count($item->pengajuans)}}</span></h2>


            </div>
        </div>

        @endforeach
    </div>
    <!-- end row -->



    <div class="row">

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body" style="height: 35rem;">

                    <div class="card-widgets">
                        <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                        <a data-toggle="collapse" href="#cardCollpase18" role="button" aria-expanded="false"
                            aria-controls="cardCollpase18"><i class="mdi mdi-minus"></i></a>
                        <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                    </div>
                    <h4 class="header-title mb-0">Coloumn Chart</h4>



                    <livewire:livewire-column-chart key="{{ $columnChartModel->reactiveKey() }}"
                        :column-chart-model="$columnChartModel" />


                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body" style="height: 35rem;">
                    <div class="card-widgets">
                        <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                        <a data-toggle="collapse" href="#cardCollpase18" role="button" aria-expanded="false"
                            aria-controls="cardCollpase18"><i class="mdi mdi-minus"></i></a>
                        <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                    </div>
                    <h4 class="header-title mb-0">Pie Chart</h4>
                    <livewire:livewire-pie-chart key="{{ $pieChartModel->reactiveKey() }}"
                        :pie-chart-model="$pieChartModel" />

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <!-- INBOX -->
        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-right">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>
                    <h4 class="header-title mb-3">Inbox</h4>

                    <div class="inbox-widget" data-simplebar style="max-height: 407px;">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="{{asset('assets/images/users/user-2.jpg')}}"
                                    class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">Tomaslau</p>
                            <p class="inbox-item-text">I've finished it! See you so...</p>
                            <p class="inbox-item-date">
                                <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Reply </a>
                            </p>
                        </div>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="{{asset('assets/images/users/user-3.jpg')}}"
                                    class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">Stillnotdavid</p>
                            <p class="inbox-item-text">This theme is awesome!</p>
                            <p class="inbox-item-date">
                                <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Reply </a>
                            </p>
                        </div>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="{{asset('assets/images/users/user-4.jpg')}}"
                                    class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">Kurafire</p>
                            <p class="inbox-item-text">Nice to meet you</p>
                            <p class="inbox-item-date">
                                <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Reply </a>
                            </p>
                        </div>

                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="{{asset('assets/images/users/user-5.jpg')}}"
                                    class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">Shahedk</p>
                            <p class="inbox-item-text">Hey! there I'm available...</p>
                            <p class="inbox-item-date">
                                <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Reply </a>
                            </p>
                        </div>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="{{asset('assets/images/users/user-6.jpg')}}"
                                    class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">Adhamdannaway</p>
                            <p class="inbox-item-text">This theme is awesome!</p>
                            <p class="inbox-item-date">
                                <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Reply </a>
                            </p>
                        </div>

                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="{{asset('assets/images/users/user-3.jpg')}}"
                                    class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">Stillnotdavid</p>
                            <p class="inbox-item-text">This theme is awesome!</p>
                            <p class="inbox-item-date">
                                <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Reply </a>
                            </p>
                        </div>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="{{asset('assets/images/users/user-4.jpg')}}"
                                    class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">Kurafire</p>
                            <p class="inbox-item-text">Nice to meet you</p>
                            <p class="inbox-item-date">
                                <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Reply </a>
                            </p>
                        </div>
                    </div> <!-- end inbox-widget -->
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->

        <!-- Todos app -->
        <div class="col-xl-4 col-lg-6">
            <!-- Todo-->
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-right">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>
                    <h4 class="header-title mb-3">Todo</h4>

                    <div class="todoapp">
                        <div class="row">
                            <div class="col">
                                <h5 id="todo-message"><span id="todo-remaining"></span> of <span id="todo-total"></span>
                                    remaining</h5>
                            </div>
                            <div class="col-auto">
                                <a href="" class="float-right btn btn-light btn-sm" id="btn-archive">Archive</a>
                            </div>
                        </div>

                        <div style="max-height: 310px;" data-simplebar>
                            <ul class="list-group list-group-flush todo-list" id="todo-list"></ul>
                        </div>

                        <form name="todo-form" id="todo-form" class="needs-validation mt-3" novalidate>
                            <div class="row">
                                <div class="col">
                                    <input type="text" id="todo-input-text" name="todo-input-text" class="form-control"
                                        placeholder="Add new todo" required>
                                    <div class="invalid-feedback">
                                        Please enter your task name
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button class="btn-primary btn-md btn-block btn waves-effect waves-light"
                                        type="submit" id="todo-btn-submit">Add</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- end .todoapp-->

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

        <!-- CHAT -->
        <div class="col-xl-4 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-right">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>
                    <h4 class="header-title mb-3">Chat</h4>

                    <div class="chat-conversation">
                        <div data-simplebar style="height: 370px;">
                            <ul class="conversation-list">
                                <li class="clearfix">
                                    <div class="chat-avatar">
                                        <img src="{{asset('assets/images/users/user-5.jpg')}}" alt="male">
                                        <i>10:00</i>
                                    </div>
                                    <div class="conversation-text">
                                        <div class="ctext-wrap">
                                            <i>Geneva</i>
                                            <p>
                                                Hello!
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="clearfix odd">
                                    <div class="chat-avatar">
                                        <img src="{{asset('assets/images/users/user-1.jpg')}}" alt="Female">
                                        <i>10:01</i>
                                    </div>
                                    <div class="conversation-text">
                                        <div class="ctext-wrap">
                                            <i>Dominic</i>
                                            <p>
                                                Hi, How are you? What about our next meeting?
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="clearfix">
                                    <div class="chat-avatar">
                                        <img src="{{asset('assets/images/users/user-5.jpg')}}" alt="male">
                                        <i>10:01</i>
                                    </div>
                                    <div class="conversation-text">
                                        <div class="ctext-wrap">
                                            <i>Geneva</i>
                                            <p>
                                                Yeah everything is fine
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="clearfix odd">
                                    <div class="chat-avatar">
                                        <img src="{{asset('assets/images/users/user-1.jpg')}}" alt="male">
                                        <i>10:02</i>
                                    </div>
                                    <div class="conversation-text">
                                        <div class="ctext-wrap">
                                            <i>Dominic</i>
                                            <p>
                                                Wow that's great
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <form class="needs-validation" novalidate name="chat-form" id="chat-form">
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control chat-input" placeholder="Enter your text"
                                        required>
                                    <div class="invalid-feedback">
                                        Please enter your messsage
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="submit"
                                        class="btn btn-danger chat-send btn-block waves-effect waves-light">Send</button>
                                </div>
                            </div>
                        </form>

                    </div> <!-- end .chat-conversation-->
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div> <!-- end row -->

</div>
</div>
@push('scripts')
<script>
    $(document).ready(function() {
    $("#flip").datepicker({
  
    showOtherMonths: true,
    selectOtherMonths: true,
    autoclose: true,
    changeMonth: true,
    changeYear: true,
    orientation: "bottom left" // left bottom of the input field
}); 

}); 


</script>
@endpush