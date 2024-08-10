<x-app-layout>

			<center class="p-3"><h3>عدد مرات الغياب في سجل شهر {{$month}}</h3></center>
			<div class="panel">
				<table style="width:100%;" class="table-bordered">
					<tr>
						<td>الأسم</td>
						<td>عدد مرات الغياب</td>
					</tr>
					@foreach($absents as $absent)
					<tr>
						<td>[{{$absent->student_id}}] {{$absent->full_name}}</td>
						<td>{{$absent->absent_times}}</td>
					</tr>
					@endforeach
				</table>
			</div>
</x-app-layout>
