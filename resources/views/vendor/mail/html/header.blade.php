<tr>
  <td class="header">
    <a href="{{ $url }}" style="display: inline-block;">
      @if (trim($slot) === 'Laravel')
      <img src="https://avatars.githubusercontent.com/u/91695677?s=280&v=4" class="logo" alt="Laravel Logo">
      @else
      {{ $slot }}
      @endif
    </a>
  </td>
</tr>
