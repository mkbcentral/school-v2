<div>
    @php
        $total = 0;
    @endphp
    <x-navigation.bread-crumb icon='fas fa-chart-pie' label="Situation Frais par section">
        <x-navigation.bread-crumb-item label='Menu' link='main' isLinked=true />
        <x-navigation.bread-crumb-item label='Dashboard' link='dashboard.main' isLinked=true />
        <x-navigation.bread-crumb-item label="Situation Frais de l'Etat" />
    </x-navigation.bread-crumb>
    <x-content.main-content-page>
        <div class="card">
            <div class="card-body mt-4">
                <div class="row">
                    @foreach ($sections as $section)
                        <div class="col-md-4">
                            <div class="bg-primary p-2 rounded">
                                <h3>{{ $section->name }}</h3>
                                <h5>USD {{ app_format_number($section->getCostBySectionAmount()) }}</h5>
                            </div>

                        </div>
                        @php
                            $total += $section->getCostBySectionAmount();
                        @endphp
                    @endforeach
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <h3>Total: {{ app_format_number($total) }}</h3>
                </div>
            </div>
        </div>
    </x-content.main-content-page>
</div>
