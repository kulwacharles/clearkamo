<div class="global-search" wire:keydown.escape="hideSuggestions">
    <form wire:submit.prevent="search" class="global-search-form" autocomplete="off">
        <input
            type="text"
            wire:model.live.debounce.250ms="query"
            wire:focus="$set('showSuggestions', true)"
            placeholder="Search services, projects, vacancies, publications..."
            class="global-search-input"
        >
        <button type="submit" class="global-search-btn"><i class="far fa-search"></i></button>
    </form>

    @if($showSuggestions && count($suggestions) > 0)
        <div class="global-search-suggestions">
            @foreach($suggestions as $item)
                <button type="button" class="global-search-item" wire:click="openResult('{{ $item['url'] }}')">
                    <span class="badge">{{ $item['type'] }}</span>
                    <span class="title">{{ $item['title'] }}</span>
                    @if(!empty($item['snippet']))
                        <small class="snippet">{{ $item['snippet'] }}</small>
                    @endif
                </button>
            @endforeach
            <button type="button" class="global-search-item view-all" wire:click="search">
                View all results for "{{ $query }}"
            </button>
        </div>
    @endif

    <style>
        .global-search { position: relative; width: 360px; }
        .global-search-form { display: flex; align-items: center; gap: 0; }
        .global-search-input {
            width: 100%; height: 44px; border: 1px solid #dbe4ff;
            border-radius: 10px 0 0 10px; padding: 0 14px; background: #ffffff;
            color: #0f172a; font-size: 14px;
        }
        .global-search-input::placeholder { color: #64748b; }
        .global-search-btn {
            width: 48px; height: 44px; border: 1px solid rgba(255,255,255,.35); border-left: 0;
            border-radius: 0 10px 10px 0; background: linear-gradient(135deg, #03A4FC, #03A4FC); color: #fff;
            transition: all .2s ease;
        }
        .global-search-btn:hover {
            background: linear-gradient(135deg, #03A4FC, #03A4FC);
        }
        .global-search-suggestions {
            position: absolute; top: 48px; left: 0; right: 0; z-index: 50;
            background: #fff; border-radius: 12px; border: 1px solid #e5e7eb;
            box-shadow: 0 12px 30px rgba(0,0,0,.15); max-height: 420px; overflow: auto;
        }
        .global-search-item {
            width: 100%; text-align: left; border: 0; background: transparent;
            padding: 10px 12px; border-bottom: 1px solid #f1f5f9; display: block;
        }
        .global-search-item:hover { background: #f8fafc; }
        .global-search-item .badge {
            display: inline-block; margin-bottom: 3px; font-size: 10px; font-weight: 700;
            background: rgba(3,164,252,0.15); color: #03A4FC; border-radius: 999px; padding: 2px 7px;
        }
        .global-search-item .title { display: block; color: #0f172a; font-weight: 600; font-size: 14px; }
        .global-search-item .snippet { display: block; color: #64748b; margin-top: 2px; font-size: 12px; }
        .global-search-item.view-all { color: #03A4FC; font-weight: 700; }
        @media (max-width: 1200px) {
            .global-search { width: 300px; }
        }
        @media (max-width: 991px) {
            .global-search { display: none; }
        }
    </style>
</div>
