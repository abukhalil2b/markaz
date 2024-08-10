@php
  use App\Helper\Helperfunction;
 
  $userWorkperiod = Helperfunction::getUserWorkperiod();
  
@endphp


{{ $userWorkperiod->title }}
<div>
  @if($userWorkperiod->gender == 'f')
  <span class="text-red-900 font-bold">نساء</span>
  @else
  <span class="text-red-900 font-bold">ذكور</span>
  @endif
</div>

