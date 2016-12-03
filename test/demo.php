require_once(__DIR__ . '/../res/ParserClass.php.php');
class ParsingTextTest extends PHPUnit_Framework_TestCase {

    public function testExceptionIsRaisedForInvalidConstructorArguments(){
    	new ParsingText($dword);
    }

public function testTextParsingReturns(){

    $txt_rep = array(
        'name' => 'Mario'
    );
    
    $str1 = "It's me {name}";
    
  		$parser = new ParsingText($txt_rep);
        $parsed_t = $parser->parseText($str1);
  		$this->assertEquals('It's me Mario', $parsed_t);
  	}

}
