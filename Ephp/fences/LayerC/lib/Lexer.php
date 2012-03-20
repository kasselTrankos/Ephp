<?php
namespace LayerC\lib;
use LayerC\lib\Loader;
class Lexer{
	private $found, $vars, $html, $parent=NULL, $generateHTML='', $cursor, $end;

	private $regex, $positions, $positionsbegin, $tokens;
	private $state, $position = -1;
	const STATE = 0;
	const TAGS 	= -1;
	const PIECE = -2;
	private $method=array(
		'tag'	=> array('{{', '}}'),
		'piece'	=> array('{%', '%}')

	);
	public function __construct($html, $vars){
	
		$this->vars = $vars;
		$this->html = $html;
		$this->cursor = 0;
		$this->regex=array(
			'PIECES'		=> '/.+'.preg_quote($this->method['piece'][1], '/').'/',
			'TAGS' 			=> '/.+'.preg_quote($this->method['tag'][1], '/').'/',			
			'lex_tokens_start'=> '/('.preg_quote($this->method['tag'][0], '/').'|'.preg_quote($this->method['piece'][0], '/').')?/s'
		);

		$this->end=strlen($this->html);
		$this->make();
		
	}
	public function get(){return $this->tokens;}
	private function make(){
		preg_match_all($this->regex['lex_tokens_start'], $this->html, $matches, PREG_OFFSET_CAPTURE);
		$this->positions = $matches[1];
		
		$this->state = self::STATE;
		while($this->cursor < $this->end){
			switch ($this->state) {
				case self::STATE:
					$this->ADD();
					break;
				case self::TAGS:					
					$this->addDefinition();
				break;
				case self::PIECE:
					$this->addPiece();
				break;
				default:
					# code...
					break;
			}
		}
		
	}
	private function ADD(){

		$end = count($this->positions)-1;
		
		if(++$this->position >= $end) $this->cursor = $this->end;
		if(is_array($this->positions[$this->position]))
		{
			$this->cursor= $this->positions[$this->position][1];
			switch ($this->positions[$this->position][0]) {
				case $this->method['tag'][0]:

					$this->addDefinition();
					break;
				case $this->method['piece'][0]:
					$this->addPiece();
					break;
				default:
					# code...
					break;
			}
		}
		
		
	}

	private function addDefinition()
	{
		if(preg_match($this->regex['TAGS'], $this->html, $match, null, $this->cursor)){

			$this->tokens["TAGS"][]=array(
				"text"=>$match[0],
				"start"=>$this->cursor,				
				"length"=>strlen($match[0])
			);
			$this->moveCursor($match[0]);	
		}
		


	}
	private function addPiece()
	{
		

		if(preg_match($this->regex['PIECES'], $this->html, $match, null, $this->cursor))
		{
			$this->tokens["PIECES"][]=array(
				"start"=>$this->cursor,
				"text"=>$match[0],
				"length"=>strlen($match[0])
			);
			$this->moveCursor($match[0]);	
		}
	}
	private function moveCursor($val){
		$this->cursor += strlen($val);
	}
}

?>