<x-app-layout>
	<h2 class="font-semibold text-xl text-gray-800 leading-tight">
		{{$studentHasMission->student->full_name}}
	</h2>

	<div class="px-3">
		<h4 class="text-center">{{$studentHasMission->mission_title}}</h4>
		<h6 class="text-center">{{$studentHasMission->mission_description}}</h6>
		<h6 class="text-center py-3 text-red-800">عدد المحاولات:{{$studentHasMission->try_number}}</h6>

		<form action="{{route('student.hesas_review_store',$studentHasMission->id)}}" method="post" x-data="{
            total: 0,
            showAddPoint:false,
            evaluation:'',

            addEvaluation(eval){
                this.evaluation = eval;
                this.showAddPoint = true;
                if(eval == 'لم ينجح'){
                    this.total = 0;
                    this.showAddPoint = false;
                }
            }
        }">
			@csrf
			<div class="row">

				<div class="col-lg-12  mt-5">
					<x-input-add-wrong-number-with-note :allowedWrongNumber="$studentHasMission->mission->allowed_wrong_number" />
				</div>


				<div class="flex flex-col items-center" x-data="{stop_number:0,attention_number:0,
addStopNumber(){
	this.stop_number = this.stop_number + 1
},
subStopNumber(){
	if (this.stop_number != 0) {
		this.stop_number = this.stop_number - 1
	}
},
addAttentionNumber(){
	this.attention_number = this.attention_number + 1
},
subAttentionNumber(){
	if (this.attention_number != 0) {
		this.attention_number = this.attention_number - 1
	}
}}">

					<div class="mt-2 flex gap-2">
						<div class="card w-80 h-14 justify-between">
							عدد التوقفات
							<div class="flex gap-1">
								<div class="w-8 text-red-800 font-bold text-2xl" x-text="stop_number"></div>
								<div class="card w-16 h-10 cursor-pointer" @click="addStopNumber">+</div>
								<div class="card w-16 h-10 cursor-pointer" @click="subStopNumber">-</div>
								<div class="card w-16 h-10 cursor-pointer" @click="stop_number = 0">0</div>
							</div>
						</div>
					</div>

					<div class="mt-2 flex gap-2">
						<div class="card w-80 h-14 justify-between">
							عدد التنبيهات
							<div class="flex gap-1">
								<div class="w-8 text-red-800 font-bold text-2xl" x-text="attention_number"></div>
								<div class="card w-16 h-10 cursor-pointer" @click="addAttentionNumber">+</div>
								<div class="card w-16 h-10 cursor-pointer" @click="subAttentionNumber">-</div>
								<div class="card w-16 h-10 cursor-pointer" @click="attention_number = 0">0</div>
							</div>
						</div>
					</div>
					<input type="hidden" x-model="stop_number" name="stop_number" value="0">
					<input type="hidden" x-model="attention_number" name="attention_number" value="0">
				</div>

				<div class="col-lg-12" id="">
					<x-input-add-point-with-valuation />
				</div>


				<div class="col-lg-12">
					<x-textarea-add-note name="normal_note" />
				</div>

			</div>
			<div class="col-lg-12">
				<div class="input-container " x-cloak x-show=" evaluation != '' ">
					<button class="mt-5 btn btn-outline-secondary w-full">
						حفظ
					</button>
				</div>
			</div>
		</form>
	</div>
</x-app-layout>