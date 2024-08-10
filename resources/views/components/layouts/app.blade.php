<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- css -->
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <link rel="stylesheet" href="{{asset('font-awesome-4.7.0/css/font-awesome.min.css')}}" />
  <link rel="stylesheet" href="{{asset('DataTables/datatables.css')}}" />
  <link rel="stylesheet" href="{{asset('bootstrap-5.2.0-dist/css/bootstrap.rtl.min.css')}}" />


  <!-- custom  css-->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

  <!-- script -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{asset('bootstrap-5.2.0-dist/js/bootstrap.bundle.min.js')}}" defer></script>
  <script src="{{asset('DataTables/jQuery-3.6.0/jquery-3.6.0.min.js')}}"></script>

  <!-- custom js -->
  <script src="{{ asset('js/script.js') }}" defer></script>

  <title>@yield('title','مؤسسة دار الإتقان العالي')</title>
</head>

<body>

  @include('layouts._app_sidebar')
  <!-- main -->
  <div id="main">

    <header>
      <!-- start ofsmall screen  -->
      <div class="smallScreenLogo">
        <a href="{{ route('dashboard') }}">
          <img class="logo" src="{{ asset('img/logo.png') }}" alt="" />
        </a>
      </div>
      <div class="smallScreenMenuButton">
        <div class="menuBar"></div>
      </div>
      <!-- end ofsmall screen -->

      <!-- start of user -->
      <div class="user" id="user">
        <div class="dropdown">
          <i class="dropbtn fa fa-user-circle-o" data-bs-toggle="dropdown" aria-expanded="false"></i>

          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">الملف الشخصي</a></li>
            <li>
              <!-- start of logout -->
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')" style="margin-top: 10%" onclick="event.preventDefault();
		            this.closest('form').submit();">
                  <span class="text-red-800">تسجيل الخروج</span>
                </x-dropdown-link>
              </form>
              <!-- end of logout -->
            </li>
          </ul>
        </div>

        <div class="name">
          <!-- username -->
          <div></div>
          <!-- user type -->
          <div class="extra-small">
            
          </div>

          <!-- start of notification -->
          @include('layouts._notification')
          <!-- end of notification -->
        </div>

      </div>
      <!-- end of user -->

      <!-- start of impersonate -->
      @if(Auth::user()->isImpersonating())
      <hr>
      <div class="text-[11px] text-center">
          <a style="color:red;" href="{{route('disable_impersonate')}}">تسجيل الخروج من حساب {{ Auth::user()->first_name }} </a>
      </div>
      @endif
      <!-- end of impersonate -->

      <!-- start of change workperiod -->
      @if(auth()->user()->permission('change_workperiod'))
      <div class="text-center text-sm">
        <button data-bs-toggle="modal" data-bs-target="#changeWorkperiodModal" class="bar3 inline-block">
          @include('layouts._userWorkperiod')
        </button>
      </div>
      @include('layouts._change_workperiod_modal')
      @endif
      <!-- end of change workperiod -->

    </header>
    <!-- environment -->
    @if(App::environment(['local', 'testing', 'staging']))
        <div class="flex items-center justify-center">
          <div class="w-full p-1 text-red-600 bg-black text-sm text-center">
            {{ App::environment() }}
          </div>
        </div>
        @endif

    <!-- start  of content -->
    <div class="min-h-screen bg-gray-100">
      @if (isset($header))
      <div class="bg-white shadow p-3">
        {{ $header }}
      </div>
      @endif

      <!-- start  of status  -->
      @if (session('status'))
      <div class="bg-white shadow p-3">

        <div class="alert alert-{{session('status')}}">
          {{ session('message') }}
        </div>

      </div>
      @endif
      <!-- end  of errors  -->

      <!-- start  of errors  -->
      @if($errors->any())
      <div class="bg-white shadow p-3">

        <div class="alert alert-danger">
          @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </div>

      </div>
      @endif
      <!-- end  of errors  -->

      <!-- Page Content -->
      <main class="p-3">
        {{ $slot }}
      </main>
      <!-- end of content -->

      <!-- footer -->
      <footer class="mt-5 p-5 border-t-2">

      </footer>
    </div>
    <script src="{{asset('DataTables/datatables.js')}}" defer></script>
    <script>
      /* --  language --*/
      var language = {
        infoEmpty: "",
        infoFiltered: "",
        info: "",
        lengthMenu: "أظهر _MENU_ مدخلات",
        zeroRecords: "لايوجد نتائج تتطابق بحثك",
        search: "",
        sSearchPlaceholder: "تصفية",
        paginate: {
          first: "الأول",
          previous: "السابق",
          next: "التالي",
          last: "الأخير"
        },
      };

      /* --  student DataTable --*/
      $(document).ready(function() {
        $(".jsDataTable").DataTable({
          //   columnDefs: [
          //     {
          //         target: 2,
          //         visible: false,
          //         searchable: false,
          //     },
          //     {
          //         target: 3,
          //         visible: false,
          //     },
          // ],
          //   order: [[ 3, 'desc' ], [ 0, 'asc' ]],
          scrollX: true,
          pageLength: 150,
          //   paging: false,
          ordering: false,
          language: language,
        });
      });
    </script>
</body>

</html>