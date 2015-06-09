using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

using System.Drawing;

namespace IAGenetic_DrawingMuse.Genetic
{
    class IndividualColor
    {
        private Dictionary<string, GeneColor> genome;

        public IndividualColor(Color _pixel )
        {
            genome = new Dictionary<string ,GeneColor>();
            genome.Add("A", new GeneColor(_pixel.A));
            genome.Add("R", new GeneColor(_pixel.R));
            genome.Add("G", new GeneColor(_pixel.G));
            genome.Add("B", new GeneColor(_pixel.B));
        }

        public int GetFitness(IndividualColor _goal)
        {
            Dictionary<string, GeneColor> genomeGoal = _goal.GetGenome();

            return genome["A"].GetFitness(genomeGoal["A"].GetColor()) +
                    genome["R"].GetFitness(genomeGoal["R"].GetColor()) +
                    genome["G"].GetFitness(genomeGoal["G"].GetColor()) +
                    genome["B"].GetFitness(genomeGoal["B"].GetColor())
                ;
        }

        public Dictionary<string, GeneColor> GetGenome()
        {
            return genome;
        }

        public string GetARGBCode()
        {
            return genome["A"].Get3DigitCode() +
                genome["R"].Get3DigitCode() +
                genome["G"].Get3DigitCode() +
                genome["B"].Get3DigitCode();
        }

        public Color GetColor()
        {
            return Color.FromArgb(
                genome["A"].GetColor(),
                genome["R"].GetColor(),
                genome["G"].GetColor(),
                genome["B"].GetColor()
            );
        }
    }
}
