{{--@foreach ($data['transactions'] as $trac)--}}
<div class="x-transaction">
    <table class="">
            <tr>
                <th>Валюта</th>
                <th>От кого</th>
                <th>Кому</th>
                <th>Инфо</th>
                <th>Дата</th>
            </tr>
            <tr>
                <td class="value">-12 ETH (0.01 BTC | 123.1231 tokens)</td>
                <td class="from">0xcDa342715528b24eb5E840B847e83900B71dC0F1</td>
                <td class="to">0xcDa342715528b24eb5E840B847e83900B71dC0F1</td>
                <td class="info"><a href="#">etherscan</a></td>
                <td class="date">18.02.2018</td>
            </tr>
    </table>

    {{--<div class="x-ac-transaction panel-group" id="accordion">--}}
        {{--<div class="panel panel-default">--}}
            {{--<div class="panel-heading">--}}
                {{--<h4 class="panel-title">--}}
                    {{--<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">0x7c496769a6651f2af93cacbd57a79da29c70a55221c705cbc6c73cbef0403ec4</a>--}}
                {{--</h4>--}}
            {{--</div>--}}
            {{--<div id="collapse1" class="panel-collapse collapse">--}}
                {{--<div class="panel-body">--}}
                    {{--<section>--}}
                        {{--<span class="title">Валюта</span>--}}
                        {{--<span class="value">-12 ETH (0.01 BTC | 123.1231 tokens)</span>--}}
                    {{--</section>--}}
                    {{--<section>--}}
                        {{--<span class="title">От кого</span>--}}
                        {{--<span class="value">0xcDa342715528b24eb5E840B847e83900B71dC0F1</span>--}}
                    {{--</section>--}}
                    {{--<section>--}}
                        {{--<span class="title">Кому</span>--}}
                        {{--<span class="value">0xcDa342715528b24eb5E840B847e83900B71dC0F1</span>--}}
                    {{--</section>--}}
                    {{--<section>--}}
                        {{--<span class="title">Инфо</span>--}}
                        {{--<span class="value"><a href="#">etherscan</a></span>--}}
                    {{--</section>--}}
                    {{--<section>--}}
                        {{--<span class="title">Дата</span>--}}
                        {{--<span class="value">18.02.2018</span>--}}
                    {{--</section>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="panel panel-default">--}}
            {{--<div class="panel-heading">--}}
                {{--<h4 class="panel-title">--}}
                    {{--<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">0x7c496769a6651f2af93cacbd57a79da29c70a55221c705cbc6c73cbef0403ec4</a>--}}
                {{--</h4>--}}
            {{--</div>--}}
            {{--<div id="collapse2" class="panel-collapse collapse">--}}
                {{--<div class="panel-body">--}}
                    {{--<section>--}}
                        {{--<span class="title">Валюта</span>--}}
                        {{--<span class="value">-12 ETH (0.01 BTC | 123.1231 tokens)</span>--}}
                    {{--</section>--}}
                    {{--<section>--}}
                        {{--<span class="title">От кого</span>--}}
                        {{--<span class="value">0xcDa342715528b24eb5E840B847e83900B71dC0F1</span>--}}
                    {{--</section>--}}
                    {{--<section>--}}
                        {{--<span class="title">Кому</span>--}}
                        {{--<span class="value">0xcDa342715528b24eb5E840B847e83900B71dC0F1</span>--}}
                    {{--</section>--}}
                    {{--<section>--}}
                        {{--<span class="title">Инфо</span>--}}
                        {{--<span class="value"><a href="#">etherscan</a></span>--}}
                    {{--</section>--}}
                    {{--<section>--}}
                        {{--<span class="title">Дата</span>--}}
                        {{--<span class="value">18.02.2018</span>--}}
                    {{--</section>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="panel panel-default">--}}
            {{--<div class="panel-heading">--}}
                {{--<h4 class="panel-title">--}}
                    {{--<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">0x7c496769a6651f2af93cacbd57a79da29c70a55221c705cbc6c73cbef0403ec4</a>--}}
                {{--</h4>--}}
            {{--</div>--}}
            {{--<div id="collapse3" class="panel-collapse collapse">--}}
                {{--<div class="panel-body">--}}
                    {{--<section>--}}
                        {{--<span class="title">Валюта</span>--}}
                        {{--<span class="value">-12 ETH (0.01 BTC | 123.1231 tokens)</span>--}}
                    {{--</section>--}}
                    {{--<section>--}}
                        {{--<span class="title">От кого</span>--}}
                        {{--<span class="value">0xcDa342715528b24eb5E840B847e83900B71dC0F1</span>--}}
                    {{--</section>--}}
                    {{--<section>--}}
                        {{--<span class="title">Кому</span>--}}
                        {{--<span class="value">0xcDa342715528b24eb5E840B847e83900B71dC0F1</span>--}}
                    {{--</section>--}}
                    {{--<section>--}}
                        {{--<span class="title">Инфо</span>--}}
                        {{--<span class="value"><a href="#">etherscan</a></span>--}}
                    {{--</section>--}}
                    {{--<section>--}}
                        {{--<span class="title">Дата</span>--}}
                        {{--<span class="value">18.02.2018</span>--}}
                    {{--</section>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="panel-group" id="accordion">--}}
        {{--<div class="panel panel-default">--}}
            {{--<div class="panel-heading">--}}
                {{--<h4 class="panel-title">--}}
                    {{--<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">--}}
                        {{--Collapsible Group 1</a>--}}
                {{--</h4>--}}
            {{--</div>--}}
            {{--<div id="collapse1" class="panel-collapse collapse in">--}}
                {{--<div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,--}}
                    {{--sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad--}}
                    {{--minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea--}}
                    {{--commodo consequat.</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="panel panel-default">--}}
            {{--<div class="panel-heading">--}}
                {{--<h4 class="panel-title">--}}
                    {{--<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">--}}
                        {{--Collapsible Group 2</a>--}}
                {{--</h4>--}}
            {{--</div>--}}
            {{--<div id="collapse2" class="panel-collapse collapse">--}}
                {{--<div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,--}}
                    {{--sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad--}}
                    {{--minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea--}}
                    {{--commodo consequat.</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="panel panel-default">--}}
            {{--<div class="panel-heading">--}}
                {{--<h4 class="panel-title">--}}
                    {{--<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">--}}
                        {{--Collapsible Group 3</a>--}}
                {{--</h4>--}}
            {{--</div>--}}
            {{--<div id="collapse3" class="panel-collapse collapse">--}}
                {{--<div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,--}}
                    {{--sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad--}}
                    {{--minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea--}}
                    {{--commodo consequat.</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="x-ac-transaction" id="accordion">
        <h3>id => 0x7c496769a6651f2af93cacbd57a79da29c70a55221c705cbc6c73cbef0403ec4</h3>
        <div>
            <section>
                <span class="title">Валюта</span>
                <span class="value">-12 ETH (0.01 BTC | 123.1231 tokens)</span>
            </section>
            <section>
                <span class="title">От кого</span>
                <span class="value from">0xcDa342715528b24eb5E840B847e83900B71dC0F1</span>
            </section>
            <section>
                <span class="title">Кому</span>
                <span class="value to">0xcDa342715528b24eb5E840B847e83900B71dC0F1</span>
            </section>
            <section>
                <span class="title">Инфо</span>
                <span class="value info"><a href="#">etherscan</a></span>
            </section>
            <section>
                <span class="title">Дата</span>
                <span class="value">18.02.2018</span>
            </section>
        </div>
        <h3>id => 0x7c496769a6651f2af93cacbd57a79da29c70a55221c705cbc6c73cbef0403ec4</h3>
        <div>
            <section>
                <span class="title">Валюта</span>
                <span class="value">-12 ETH (0.01 BTC | 123.1231 tokens)</span>
            </section>
            <section>
                <span class="title">От кого</span>
                <span class="value from">0xcDa342715528b24eb5E840B847e83900B71dC0F1</span>
            </section>
            <section>
                <span class="title">Кому</span>
                <span class="value to">0xcDa342715528b24eb5E840B847e83900B71dC0F1</span>
            </section>
            <section>
                <span class="title">Инфо</span>
                <span class="value info"><a href="#">etherscan</a></span>
            </section>
            <section>
                <span class="title">Дата</span>
                <span class="value">18.02.2018</span>
            </section>
        </div>
        <h3>id => 0x7c496769a6651f2af93cacbd57a79da29c70a55221c705cbc6c73cbef0403ec4</h3>
        <div>
            <section>
                <span class="title">Валюта</span>
                <span class="value">-12 ETH (0.01 BTC | 123.1231 tokens)</span>
            </section>
            <section>
                <span class="title">От кого</span>
                <span class="value from">0xcDa342715528b24eb5E840B847e83900B71dC0F1</span>
            </section>
            <section>
                <span class="title">Кому</span>
                <span class="value to">0xcDa342715528b24eb5E840B847e83900B71dC0F1</span>
            </section>
            <section>
                <span class="title">Инфо</span>
                <span class="value info"><a href="#">etherscan</a></span>
            </section>
            <section>
                <span class="title">Дата</span>
                <span class="value">18.02.2018</span>
            </section>
        </div>
        <h3>id => 0x7c496769a6651f2af93cacbd57a79da29c70a55221c705cbc6c73cbef0403ec4</h3>
        <div>
            <section>
                <span class="title">Валюта</span>
                <span class="value">-12 ETH (0.01 BTC | 123.1231 tokens)</span>
            </section>
            <section>
                <span class="title">От кого</span>
                <span class="value from">0xcDa342715528b24eb5E840B847e83900B71dC0F1</span>
            </section>
            <section>
                <span class="title">Кому</span>
                <span class="value to">0xcDa342715528b24eb5E840B847e83900B71dC0F1</span>
            </section>
            <section>
                <span class="title">Инфо</span>
                <span class="value info"><a href="#">etherscan</a></span>
            </section>
            <section>
                <span class="title">Дата</span>
                <span class="value">18.02.2018</span>
            </section>
        </div>
    </div>
</div>

{{--@endforeach--}}


