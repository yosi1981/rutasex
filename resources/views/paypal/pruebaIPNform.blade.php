<form target="_new" method="post" action="http://latiendadeyosi.com/paypalIPN">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="SomePayPalVar" value="SomeValue1"/>
  <input type="hidden" name="SomeOtherPPVar" value="SomeValue2"/>

  <!-- code for other variables to be tested ... -->

  <input type="submit"/>
</form>
