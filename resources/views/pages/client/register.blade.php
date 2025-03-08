<x-client-layout>
    <div class="content d-flex justify-content-center align-items-center">

        <livewire:client.intern-ship-register  campaignId="{{$campaignId}}" />
        <livewire:client.teacher-modal campaignId="{{$campaignId}}"/>
        <livewire:client.company-modal/>
    </div>
</x-client-layout>
