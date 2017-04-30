<form  method="post" action="http://localhost:8000/paypalIPN">
  <input type="hidden" name="SomePayPalVar" value="SomeValue1"/>
  <input type="hidden" name="SomeOtherPPVar" value="SomeValue2"/>

  <!-- code for other variables to be tested ... -->

  <input type="submit"/>
  {{Form::token()}}
</form>