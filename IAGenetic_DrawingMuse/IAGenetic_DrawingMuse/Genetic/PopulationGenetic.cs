using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

using System.Drawing;

namespace IAGenetic_DrawingMuse.Genetic
{
    class PopulationGenetic : Population
    {
        private Random random;
        private int nbIndividuals;
        private int iGeneration;
        private int fitnessTotal;
        private DateTime startTime;
        private DateTime endTime;
        private int MAX_GENERATIONS;
        private int MIN_FITNESS_PERCENTAGE;
        private int MIN_FITNESS;
        private int CROSSOVER_PERCENTAGE;
        private int MUTATION_PERCENTAGE;

        public PopulationGenetic(PopulationGoal _goal)
        {
            random = new Random();
            fitnessTotal = 0; // The more, the farer we are from our goal
            MAX_GENERATIONS = 10;
            MIN_FITNESS_PERCENTAGE = 100;
            MIN_FITNESS = 0;
            CROSSOVER_PERCENTAGE = 10;
            MUTATION_PERCENTAGE = 03;

            width = _goal.GetWitdh();
            height = _goal.GetHeight();
            nbIndividuals = width * height;
            individuals = new IndividualColor[nbIndividuals];
            InitPopulation(_goal.GetPalette());
        }

        private void InitPopulation(Dictionary<string, IndividualColor> _palette)
        {
            int iIndividual = 0;
            List<string> paletteKeys = Enumerable.ToList(_palette.Keys);
            int paletteSize = _palette.Count();
            
            // Don't be racist ;) and all the colours
            foreach (string paletteKey in paletteKeys)
            {
                individuals[iIndividual] = _palette[paletteKey];
                iIndividual++;
            }

            // Complete with other random color from the palette
            while(iIndividual < nbIndividuals)
            {
                individuals[iIndividual] = _palette[paletteKeys[random.Next(0, paletteSize)]];
                iIndividual++;
            }
        }

        public void Evolve(PopulationGoal _goal)
        {
            IndividualColor[] individualsGoal = _goal.GetIndividuals();
            Dictionary<string, IndividualColor> palette = _goal.GetPalette();
            List<string> paletteKeys = Enumerable.ToList(palette.Keys);

            iGeneration = 0;
            startTime = DateTime.Now;
            CalculateFitness(individualsGoal);

            while(iGeneration < MAX_GENERATIONS && fitnessTotal > MIN_FITNESS)
            {
                // Selection and reproduction phase
                IndividualColor[] newGeneration = Reproduce(individualsGoal);

                // Mutation phase
                newGeneration = Mutate(newGeneration, palette, paletteKeys);

                // Surviving phase and calculate fitness at the same time
                Survive(newGeneration, individualsGoal);

                iGeneration++;
                Console.WriteLine("Generation {0} : {1}", iGeneration, fitnessTotal);
            }

            endTime = DateTime.Now;
        }

        private IndividualColor SelectBest(IndividualColor _goal)
        {
            int iBest = 0;
            int bestFitness = 9999;
            bool is0FitnessgFound = false;
            int iIdividual = 0;
            int fitnessTest;

            do
            {
                // Calculate fitness
                fitnessTest = _goal.GetFitness(individuals[iIdividual]);

                // Is the fitness better ?
                if (fitnessTest < bestFitness)
                {
                    bestFitness = fitnessTest;
                    iBest = iIdividual;
                }

                // Did we find the absolute fitness ?
                if(bestFitness == 0)
                {
                    is0FitnessgFound = true;
                }

                iIdividual++;
            }while(iIdividual < nbIndividuals && !is0FitnessgFound);

            return individuals[iBest];
        }

        private GeneColor SelectBest(GeneColor _mother, GeneColor _father, GeneColor _goal)
        {
            int fitnessMother = _goal.GetFitness(_mother.GetColor());
            int fitnessFather = _goal.GetFitness(_father.GetColor());
            return fitnessMother < fitnessFather ? _mother : _father;
        }

        private Color SelectBest( Dictionary<string, GeneColor> _genomeMother,
                                    Dictionary<string, GeneColor> _genomeFather,
                                    Dictionary<string, GeneColor> _genomeGoal
                                )
        {
            return Color.FromArgb( 
                SelectBest(_genomeMother["A"], _genomeFather["A"], _genomeGoal["A"]).GetColor(),
                SelectBest(_genomeMother["R"], _genomeFather["R"], _genomeGoal["R"]).GetColor(),
                SelectBest(_genomeMother["G"], _genomeFather["G"], _genomeGoal["G"]).GetColor(),
                SelectBest(_genomeMother["B"], _genomeFather["B"], _genomeGoal["B"]).GetColor()
            );
        }

        private void Survive(IndividualColor[] _new, IndividualColor[] _goal)
        {
            fitnessTotal = 0;
            int fitnessActu, fitnessNew;

            for (int iIndividual = 0; iIndividual < nbIndividuals; iIndividual++)
            {
                fitnessActu = _goal[iIndividual].GetFitness(individuals[iIndividual]);
                fitnessNew = _goal[iIndividual].GetFitness(_new[iIndividual]);

                if (fitnessNew >= fitnessActu)
                {
                    individuals[iIndividual] = _new[iIndividual];
                    fitnessTotal += fitnessNew;
                }
                else
                {
                    fitnessTotal += fitnessActu;
                }
            }
        }

        
        // =======================================================================

        private IndividualColor[] Reproduce(IndividualColor[] _individualsGoal)
        {
            IndividualColor[] newGeneration = new IndividualColor[nbIndividuals];

            for (int iIndividual = 0; iIndividual < nbIndividuals; iIndividual++)
            {
                IndividualColor newIdividual;
                int randomCrossover = random.Next(0, 100);

                if (randomCrossover < CROSSOVER_PERCENTAGE)
                {
                    newIdividual = Crossover(_individualsGoal[iIndividual]);
                }
                else
                {
                    newIdividual = Clone(_individualsGoal[iIndividual]);
                }

                newGeneration[iIndividual] = newIdividual;
            }

            return newGeneration;
        }

        private IndividualColor Crossover(IndividualColor _goal)
        {
            IndividualColor mother = SelectBest(_goal);
            IndividualColor father = individuals[random.Next(0, nbIndividuals - 1)];

            Dictionary<string, GeneColor> genomeMother = mother.GetGenome();
            Dictionary<string, GeneColor> genomeFather = father.GetGenome();

            return new IndividualColor( SelectBest(genomeMother, genomeFather, _goal.GetGenome() ) );
        }

        private IndividualColor Clone(IndividualColor _goal)
        {
            return SelectBest(_goal);
        }

        // =======================================================================

        private IndividualColor[] Mutate( IndividualColor[] _newGeneration,
                                        Dictionary<string, IndividualColor> _palette,
                                        List<string> _paletteKeys
                                    )
        {
            int randomMutate;
            int randomColor;
            int nbIndividualsMax = _palette .Count() - 1;

            for (int iIndividual = 0; iIndividual < nbIndividuals; iIndividual++)
            {
                 randomMutate = random.Next(0, 100);

                 if(randomMutate < MUTATION_PERCENTAGE)
                 {
                     randomColor = random.Next(0, nbIndividualsMax);
                     _newGeneration[iIndividual] = _palette[_paletteKeys.ElementAt(randomColor)];
                 }
            }

            return _newGeneration;
        }

        // =======================================================================

        private void CalculateFitness(IndividualColor[] individualsGoal)
        {
            fitnessTotal = 0;

            for (int iIdividual = 0; iIdividual < nbIndividuals; iIdividual++)
            {
                fitnessTotal += individuals[iIdividual].GetFitness(individualsGoal[iIdividual]);
            }
        }

        public int GetFitness()
        {
            return fitnessTotal;
        }


        // =======================================================================

        public string GetStartTime()
        {
            return startTime.ToString();
        }

        public string GetEndTime()
        {
            return endTime.ToString();
        }


        public void SetMaxGenerations(int _maxGenerations)
        {
            MAX_GENERATIONS = _maxGenerations;
        }

        public void SetMinFitnessPercentage(int _minFitnessPercentage)
        {
            MIN_FITNESS_PERCENTAGE = _minFitnessPercentage;

            MIN_FITNESS = 0;
            if (MIN_FITNESS_PERCENTAGE < 100)
            {
                MIN_FITNESS = nbIndividuals * MIN_FITNESS_PERCENTAGE / 100;
            }
        }

        public void SetCrossoverPercentage (int _crossoverPercentage)
        {
            CROSSOVER_PERCENTAGE = _crossoverPercentage;
        }

        public void SetMutationPercentage (int _mutationPercentage)
        {
            MUTATION_PERCENTAGE = _mutationPercentage;
        }

        public string GetDuration()
        {
            return (endTime - startTime).ToString();
        }
    }
}
