<x-app-layout>

    <div class="p-3">
       النظام الجديد في وضع مهام الحفظ للطالب
    </div>
    <div class="p-1">
        ترتيب المهام تظهر من الأصغر إلى الأكبر
        <div class="gap-1 draggable-container">
            @foreach($missionTasks as $key => $missionTask)

            <div class="mt-1 w-full flex gap-1 items-center shallow-draggable" draggable="true">
                <div class="w-8 h-8 rounded bg-gray-300 text-center">
                    {{ $key + 1}}
                </div>
                <div class="w-full  p-1 border rounded bg-white">
                    {{ $missionTask->task_order}}
                    {{ $missionTask->descr}}
                </div>
            </div>

            @endforeach
        </div>

    </div>

    <script>
        const draggbles = document.querySelectorAll(".shallow-draggable")
        const containers = document.querySelectorAll(".draggable-container")

        draggbles.forEach((draggble) => {
            //for start dragging costing opacity
            draggble.addEventListener("dragstart", () => {
                draggble.classList.add("dragging")
            })

            //for end the dragging opacity costing
            draggble.addEventListener("dragend", () => {
                draggble.classList.remove("dragging")
            })
        })
        //shit
        containers.forEach((container) => {
            container.addEventListener("dragover", function(e) {
                e.preventDefault()
                const afterElement = dragAfterElement(container, e.clientY)
                const dragging = document.querySelector(".dragging")
                if (afterElement == null) {
                    container.appendChild(dragging)
                } else {
                    container.insertBefore(dragging, afterElement)
                }
            })
        })

        function dragAfterElement(container, y) {
            const draggbleElements = [...container.querySelectorAll(".shallow-draggable:not(.dragging)")]

            return draggbleElements.reduce(
                (closest, child) => {
                    const box = child.getBoundingClientRect()
                    const offset = y - box.top - box.height / 2
                    if (offset < 0 && offset > closest.offset) {
                        return {
                            offset: offset,
                            element: child
                        }
                    } else {
                        return closest
                    }
                }, {
                    offset: Number.NEGATIVE_INFINITY
                }
            ).element
        }
    </script>

    <style>
        .shallow-draggable {
            background-color: #f7ecd3;
            color: #29262b;
            padding: 1rem;
            margin-top: 2rem;
            border-radius: 5px;
            transition: opacity 200ms ease;
            cursor: move;
        }

        .dragging {
            opacity: 0.5;
            transition: opacity 1s ease;
        }
    </style>
</x-app-layout>