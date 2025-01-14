<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs mb-3" role="tablist">
            @foreach($campaigns as $campaign)
                <li class="nav-item">
                    <a href="#campaign-{{ $campaign->id }}"
                       class="nav-link {{ $loop->first ? 'active' : '' }}"
                       data-bs-toggle="tab"
                       aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                       role="tab">
                        {{ $campaign->name }}
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content">
            @foreach($campaigns as $campaign)
                <div class="tab-pane fade {{ $loop->first ? 'active show' : '' }}"
                     id="campaign-{{ $campaign->id }}"
                     role="tabpanel">
                    <livewire:company-campaign.company-campaign-show :campaignId="$campaign->id" />
                </div>
            @endforeach
        </div>
    </div>
</div>
