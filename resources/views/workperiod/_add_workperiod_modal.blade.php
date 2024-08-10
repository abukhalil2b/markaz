<div class="mb-5" x-data="modal_add_workperiod">

	<a href="#" class="btn btn-sm btn-outline-primary" @click="toggle">
		+ فترة جديدة
	</a>

	<div class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60" :class="open && '!block'">
		<div class="flex min-h-screen items-center justify-center px-4" @click.self="open = false">

			<div x-show="open" x-transition x-transition.duration.300 class="panel my-8 w-full max-w-lg overflow-hidden rounded-lg border-0 p-0">
				<div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
					<h5 class="text-lg font-bold"> فترة جديدة </h5>
					<button type="button" class="text-white-dark hover:text-dark" @click="toggle">
						<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
							<line x1="18" y1="6" x2="6" y2="18"></line>
							<line x1="6" y1="6" x2="18" y2="18"></line>
						</svg>
					</button>
				</div>

				<form method="post" action="{{ route('workperiod.store') }}" class="p-4">
					@csrf
					<div class="p-5">

						<!-- forms -->
						<div class="card-subtitle">
							العنوان
							<input name="title" class="form-input">
						</div>
				
						<div class="card-subtitle mt-3">
							وقت حضور الطالب:
							<input type="time" name="student_should_be_present_at" class="form-input">
						</div>

						<div class="card-subtitle mt-3">
							وقت حضور المشرف:
							<input type="time" name="moderator_should_be_present_at" class="form-input">
						</div>

						<div class="card-subtitle mt-3">
							وقت حضور المدرس:
							<input type="time" name="teacher_should_be_present_at" class="form-input">
						</div>
						<div class="card-subtitle mt-3">
							حدد الجنس:
							<select name="gender" class="form-select">
								<option value="m">{{__('male')}}</option>
								<option value="f">{{__('female')}}</option>
							</select>
						</div>
						<!-- /forms -->

						<div class="mt-8 flex items-center justify-end">
							<button type="button" class="btn btn-outline-danger" @click="toggle">
								إلغاء
							</button>
							<button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4" @click="toggle">
								حفظ
							</button>
						</div>
					</div>
				</form>

			</div>

		</div>
	</div>
</div>
<script>
	document.addEventListener("alpine:init", () => {
		Alpine.data("modal_add_workperiod", () => ({
			open: false,
			toggle() {
				this.open = !this.open
			}
		}))
	})
</script>