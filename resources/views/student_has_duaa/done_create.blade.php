<x-app-layout>
	<div class="py-4 text-xl">
		{{$studentHasDuaa->student->full_name}}
	</div>

	<div class="py-4">
		{{$studentHasDuaa->duaa->title}}
	</div>


	<div class="py-2 text-xs"> {!!nl2br($studentHasDuaa->duaa->content)!!} </div>

	<form action="{{route('student_has_duaa.update',$studentHasDuaa->id)}}" method="post">
		@csrf

		<div class="mt-4 text-red-800">
			عدد الأخطاء
		</div>
		<input class="form-input" type="number" name="numwrong">

		<x-textarea-add-note />

		<div class="mt-4" x-data="add_point">
			<x-input-add-point-with-valuation />
		</div>



		<button class="mt-4 btn block btn-outline-secondary w-full">
			حفظ
		</button>

	</form>



	<script>
		document.addEventListener("alpine:init", () => {

			Alpine.data("add_point", () => ({
				total: 0,
				showAddPoint: false,
				evaluation: '',

				addEvaluation(eval) {
					this.evaluation = eval;
					this.showAddPoint = true;
					if (eval == 'لم ينجح') {
						this.total = 0;
						this.showAddPoint = false;
					}
				}
			}));
		})
	</script>

</x-app-layout>