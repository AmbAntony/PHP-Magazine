
module.exports = function(socket, temp){
    return `<div class="container_pmdot display-flex direction-row align-center margin-b15 margin-l10 padding-t15">
        <div class="item-mavatar margin-r5 overflow-hidden border-rall">
            <img class="blur-up lazyload" src="{$avatar_s}" alt="{$username}">
        </div>
        <div class="content-pmdot display-flex direction-row align-center break-all background-grely padding-t5 padding-b5 padding-l15 padding-r15 overflow-hidden border-r25px">
            <div class="item-pmdot position-relative"></div>
        </div>
    </div>`;
};