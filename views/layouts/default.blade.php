<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        @include('tentapress-seo::head', ['page' => $page])

        @php
            \Illuminate\Support\Facades\Vite::useHotFile(public_path('themes/tentapress/bootstrap/hot'));
        @endphp

        @vite(['resources/css/theme.css', 'resources/js/theme.js'], 'themes/tentapress/bootstrap/build')
    </head>
    <body>
        @php
            $primaryMenu = isset($tpMenus) ? $tpMenus->itemsForLocation('primary') : [];
        @endphp

        <header class="border-bottom">
            <div class="container d-flex flex-wrap align-items-center justify-content-between gap-3 py-4">
                <div class="fw-semibold">Bootstrap Theme - TentaPress</div>
                <nav class="d-flex flex-wrap align-items-center gap-3 small text-secondary">
                    @if ($primaryMenu !== [])
                        @foreach ($primaryMenu as $item)
                            @php
                                $url = (string) ($item['url'] ?? '#');
                                $title = (string) ($item['title'] ?? 'Menu');
                                $target = isset($item['target']) && is_string($item['target']) ? $item['target'] : null;
                                $children = is_array($item['children'] ?? null) ? $item['children'] : [];
                            @endphp

                            <div class="d-flex flex-column gap-1">
                                <a
                                    href="{{ $url }}"
                                    class="link-secondary text-decoration-none"
                                    @if ($target) target="{{ $target }}" rel="noopener" @endif>
                                    {{ $title }}
                                </a>
                                @if ($children !== [])
                                    <div class="d-flex flex-wrap gap-2 small text-secondary">
                                        @foreach ($children as $child)
                                            @php
                                                $childUrl = (string) ($child['url'] ?? '#');
                                                $childTitle = (string) ($child['title'] ?? 'Menu');
                                                $childTarget = isset($child['target']) && is_string($child['target']) ? $child['target'] : null;
                                            @endphp

                                            <a
                                                href="{{ $childUrl }}"
                                                class="link-secondary text-decoration-none"
                                                @if ($childTarget) target="{{ $childTarget }}" rel="noopener" @endif>
                                                {{ $childTitle }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </nav>
            </div>
        </header>

        <main class="container py-4">
            @include('tentapress-pages::partials.blocks', [
            'blocks' => $page->blocks,
            ])
        </main>

        <footer class="border-top">
            <div class="container py-4 small text-secondary">&copy; {{ date('Y') }} TentaPress</div>
        </footer>
    </body>
</html>
