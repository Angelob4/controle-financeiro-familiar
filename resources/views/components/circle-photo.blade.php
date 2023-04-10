<div style="box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175);
             border-radius: 100%;
             border: 7px solid white;
             position: relative;
             overflow: hidden;
             {{ $attributes['top'] ? 'top: ' . $attributes['top'] . 'px;' : '' }}">
    {{ $slot }}
</div>
