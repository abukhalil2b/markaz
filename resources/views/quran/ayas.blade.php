
<div class="container">
    <center class="bar2">

    </center>
    <div class="row">
        <div class="col-lg-12">
            @foreach($ayas as $aya)
            <div class="bar2">
                {{$aya->content}} ({{$aya->number}})
            </div>
            @endforeach
        </div>
    </div>
</div>
<script>
        function getSelectedText() {
        var text = "";
        if (typeof window.getSelection != "undefined") {
            text = window.getSelection().toString();
        } else if (typeof document.selection != "undefined" && document.selection.type == "Text") {
            text = document.selection.createRange().text;
        }
        return text;
    }

    function doSomethingWithSelectedText() {
        var selectedText = getSelectedText();
        if (selectedText) {
            alert("Got selected text " + selectedText);
        }
    }

    document.onmouseup = doSomethingWithSelectedText;
    document.onkeyup = doSomethingWithSelectedText;
</script>
