<style>
    * {
        direction: rtl;

    }

    .container {
        padding: 3px;
    }

    .bar {
        margin-top: 3px;
        padding: 1px;
        border: solid 1px #000;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 16px;
        font-weight: bolder;
        background-color: #ddd;
    }

    .card {
        margin-top: 3px;
        padding: 1px;
        border: solid 1px #000;
        border-radius: 5px;
        display: flex;
        gap: 3px;
        align-items: center;
        color: #757575;
    }

    .task_order {
        display: inline-block;
        width: 30px;
        height: 30px;
        border: 1px solid #000;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 14px;
    }

    .review_view{
        font-size: 15px;
        font-weight: bolder;
        color: #000;
    }
</style>

@foreach($missions as $mission)
<div class="container">
    <div class="bar">
        {{ $mission->title }}
    </div>
    @foreach($mission->missionTasks as $missionTask)

    <div class="card {{ $missionTask->mission_type == 'review' ? 'review_view' : '' }}">
        <span class="task_order"> {{ $missionTask->task_order}} </span>
        <span class="mission_type"> {{ __($missionTask->mission_type) }} </span>
        {{ $missionTask->descr}}
    </div>

    @endforeach
</div>
@endforeach