using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace IAGenetic_DrawingMuse.Genetic
{
    class GeneColor
    {
        private int color;

        public GeneColor(int _color)
        {
            color = _color;
        }

        public int GetFitness(int _colorTest)
        {
            return Math.Abs(color - _colorTest);
        }

        public int GetColor()
        {
            return color;
        }

        public string Get3DigitCode()
        {
            return color.ToString("000");
        }
    }
}
