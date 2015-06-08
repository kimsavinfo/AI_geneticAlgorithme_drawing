using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace IAGenetic_DrawingMuse.Genetic
{
    class PopulationGenetic : Population
    {
        private Random random;
        private int nbIndividuals;

        public PopulationGenetic(PopulationGoal _goal)
        {
            random = new Random();
            width = _goal.GetWitdh();
            height = _goal.GetHeight();
            nbIndividuals = width * height;

            individuals = new IndividualColor[nbIndividuals];
            InitPopulation(_goal.GetPalette());
        }

        private void InitPopulation(Dictionary<string, IndividualColor> _palette)
        {
            int iPalette = 0;
            List<string> paletteKeys = Enumerable.ToList(_palette.Keys);
            int paletteSize = _palette.Count();
            
            // Don't be racist ;) and all the colours
            foreach (string keyIndividual in paletteKeys)
            {
                individuals[iPalette] = _palette[keyIndividual];
                iPalette++;
            }

            // Complete with other random color from the palette
            while(iPalette < nbIndividuals)
            {
                individuals[iPalette] = _palette[paletteKeys[random.Next(0, paletteSize)]];
                iPalette++;
            }
        }
    }
}
