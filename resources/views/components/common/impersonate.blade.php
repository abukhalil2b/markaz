            <!-- start of impersonate -->
            @if(Auth::user()->isImpersonating())
            <hr>
            <div class="text-[11px] text-center">
                <a style="color:red;" href="{{route('disable_impersonate')}}">تسجيل الخروج من حساب {{ Auth::user()->first_name }} </a>
            </div>
            @endif
            <!-- end of impersonate -->