<div class="container panel-default">
    <div class="referals-panel-heading">
        {{ __('home/referals.title') }}
    </div>

    <table class="table col-sm-6 task-table"> 
        <thead> 
            <th>{{ __('home/referals.stage') }}</th> 
            <th>{{ __('home/referals.conversion') }}</th> 
            <th>{{ __('home/referals.registrations') }}</th> 
            <th>{{ __('home/referals.wallets_created') }}</th> 
            <th>{{ __('home/referals.gained_tokens') }}</th> 
        </thead> 
        <tbody> 
        @foreach ($data['refs']['statistics'] as $i => $stat)
            <tr> 
                <td class="table-text"> 
                    {{ $i }} 
                </td> 
                <td class="table-text"> 
                    {{ $stat['conversions'] }} 
                </td> 
                <td class="table-text"> 
                    {{ $stat['registrations'] }} 
                </td> 
                <td class="table-text"> 
                    {{ $stat['wallets_count'] }} 
                </td> 
                <td class="table-text"> 
                    {{ $stat['tokens'] }} 
                </td> 
            </tr> 
        @endforeach
            <tr> 
                <td class="table-text"> 
                    {{ __('home/referals.total') }} 
                </td> 
                <td class="table-text"> 
                    {{ array_sum(array_column($data['refs']['statistics'], 'conversions')) }} 
                </td> 
                <td class="table-text"> 
                    {{ array_sum(array_column($data['refs']['statistics'], 'registrations')) }} 
                </td> 
                <td class="table-text"> 
                    {{ array_sum(array_column($data['refs']['statistics'], 'wallets_count')) }} 
                </td> 
                <td class="table-text"> 
                    {{ array_sum(array_column($data['refs']['statistics'], 'tokens')) }} 
                </td> 
            </tr> 
        </tbody>
    </table>
</div>