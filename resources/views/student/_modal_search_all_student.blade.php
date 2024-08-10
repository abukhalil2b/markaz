<div x-data="modal_create_subscriptionfee">

  <a href="#" class="btn btn-outline-primary btn-sm" @click="toggle"> بحث </a>

  <div class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60" :class="open && '!block'">
    <div class="flex min-h-screen items-center justify-center px-4" @click.self="open = false">
      <div x-show="open" x-transition x-transition.duration.300 class="panel my-8 w-full max-w-lg overflow-hidden rounded-lg border-0 p-0">
        <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
          <h5 class="text-lg font-bold"> بحث </h5>
          <button type="button" class="text-white-dark hover:text-dark" @click="toggle">
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
          </button>
        </div>
        <div class="p-3">

          <form action="{{ route('student.search_all_students') }}" method="post">
            @csrf

            <div class="modal-body">

              <div>
                <input name="student" class="form-input" placeholder="اسم أو رقم الطالب">
              </div>

              <div class="bar3">
                الجنس
                <label class="m-1 bg-white rounded p-1">
                  <input type="radio" name="gender" value="m">
                  ذكور فقط
                </label>

                <label class="m-1 bg-white rounded p-1">
                  <input type="radio" name="gender" value="f">
                  إناث فقط
                </label>

                <label class="m-1 bg-white rounded p-1">
                  <input type="radio" name="gender" value="allGenders" checked>
                  الذكور والإناث
                </label>

              </div>

              <div class="bar3">
                حالة الدراسة
                <label class="m-1 bg-white rounded p-1">
                  <input type="radio" name="status" value="waitingApproval">
                  ينتظر الاعتماد فقط
                </label>

                <label class="m-1 bg-white rounded p-1">
                  <input type="radio" name="status" value="active">
                  نشطين فقط
                </label>

                <label class="m-1 bg-white rounded p-1">
                  <input type="radio" name="status" value="disabled">
                  معطلين
                </label>

                <label class="m-1 bg-white rounded p-1">
                  <input type="radio" name="status" value="allStatus" checked>
                  كل الحالات
                </label>

              </div>


            </div>

            <div class="modal-footer">
              <button class="btn block btn-outline-primary mt-3">بحث</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener("alpine:init", () => {

    Alpine.data("modal_create_subscriptionfee", () => ({

      open: false,

      toggle() {
        this.open = !this.open;
      }

    }));
  })
</script>