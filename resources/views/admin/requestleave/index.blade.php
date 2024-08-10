<x-app-layout>

    <div x-data="adminRequestleavStatus">

        <div class="flex gap-3">

            <button class="btn btn-outline-primary" :class="status == 'new' ? 'bg-primary text-white' : '' " @click="setNew">قيد الدراسة</button>
            <button class="btn btn-outline-primary" :class="status == 'approved' ? 'bg-primary text-white' : '' " @click="setApproved">موافق</button>
            <button class="btn btn-outline-primary" :class="status == 'rejected' ? 'bg-primary text-white' : '' " @click="setRejected">مرفوض</button>
        </div>

        <template x-if="status == 'new' ">
            <div>
                @include('admin.requestleave.new')
            </div>
        </template>

        <template x-if="status == 'approved' ">
            <div>
                @include('admin.requestleave.approved')
            </div>
        </template>

        <template x-if="status == 'rejected' ">
            <div>
                @include('admin.requestleave.rejected')
            </div>
        </template>

    </div>


</x-app-layout>