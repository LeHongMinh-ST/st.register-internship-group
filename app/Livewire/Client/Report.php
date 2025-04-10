<?php

namespace App\Livewire\Client;


use App\Models\Campaign;
use App\Models\Group;
use App\Models\GroupKey;
use App\Models\GroupOfficial;
use App\Models\GroupStudent;
use App\Models\Student;
use App\Models\StudentGroupOfficial;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;


class Report extends Component
{
    use WithFileUploads;

    public string $key;

    public string|int $campaignId = '';

    public ?GroupOfficial $groupOfficial = null;

    #[Validate(as: 'file báo cáo tổng kết')]
    public $groupReportFile = null;

    public function render()
    {
        $campaign = Campaign::find($this->campaignId);
        return view('livewire.client.report', [
            'campaign' => $campaign,
            'groupOfficial' => $this->groupOfficial,
        ]);
    }

    public function rules(): array
    {
        return [
            'groupReportFile' => 'required|file|mimes:doc,docx',
        ];
    }

    public function mount($keyEdit)
    {
        $this->key = $keyEdit;
        $groupKey = GroupKey::query()
            ->where('key', $this->key)
            ->first();
        $this->groupOfficial = GroupOfficial::where('id', $groupKey->group_id)->firstOrFail();
        $this->campaignId = $this->groupOfficial->campaign_id;
    }

    public function submit(){
        $this->validate();
        $path = $this->groupReportFile->store('reports','public');
        $this->groupOfficial->update([
            'report_file' => $path,
            'report_status' => \App\Enums\ReportStatusEnum::PENDING->value,
        ]);

        $this->dispatch('alert', type: "success", message: "Nộp thông báo thành công");
    }
}
