<style>
    .custModal{
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: #48484869;
    display: flex;
}
.custModalContent{
    width: 450px;
    padding: 3%;
    background: white;
    border-radius: 3px;
    text-align: center;
    align-self: center;
    margin: auto;
    box-shadow: 0px 4px 6px 2px #b0b0b0;
}
</style>
<div class="custModal">
    <div class="custModalContent">
        {{ $slot }}
    </div>
</div> 