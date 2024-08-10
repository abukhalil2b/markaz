<x-app-layout>


<div class="container">
    <center class="bar2">
        <h3>المصحف</h3>
    </center>
    <div class="row">
        @foreach($sowars as $sowar)
        <div class="col-lg-4 ">
	        <div class="bar2 center-content">
	        	{{$sowar->title}}
	        </div>
        </div>
        @endforeach
    </div>
</div>

</x-app-layout>
