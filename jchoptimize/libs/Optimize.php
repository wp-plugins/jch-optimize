<?php

namespace JchOptimize;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Optimize
 *
 * @author Barnaby Engineering
 */
class Optimize
{
        //regex for double quoted strings
        const DOUBLE_QUOTE_STRING = '"(?>(?:\\\\.)?[^\\\\"]*+)+?(?:"|(?=$))';
        
        //regex for single quoted string
        const SINGLE_QUOTE_STRING = "'(?>(?:\\\\.)?[^\\\\']*+)+?(?:'|(?=$))";
}
