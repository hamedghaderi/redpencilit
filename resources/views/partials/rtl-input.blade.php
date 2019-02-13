<script>
  inputs = document.getElementsByClassName('field-rtl');

  

  Array.from(inputs).forEach(input => {
    input.addEventListener('keyup', function(e) {
      if (isPersian(this.value)) {
        this.style.direction = 'rtl';
      } else if ( this.value.trim() === '' ) {
        this.style.direction = 'rtl';
      } else if ( !isPersian(this.value) ) {
        this.style.direction = 'ltr';
      }
    });
  });

  function isPersian(value) {
    const persianUnicodeStart = 1570; // codepoint for letter 'آ'
    const persianUnicodeEnd = 1740; // codepoint for letter 'ی'

    let valueFirstCharUnicode = value.codePointAt(0);
    
    if (
      valueFirstCharUnicode <= persianUnicodeEnd 
      && valueFirstCharUnicode >= persianUnicodeStart
    ) {
      return true;
    }

    return false;
  }
</script>